import React, { useState } from "react";
import { Form, Row, Col, ToggleButton, ToggleButtonGroup, Table, Alert } from "react-bootstrap";
import { Formik, FieldArray, Form as FormikForm } from "formik";
import * as Yup from "yup";
import WizardButtons from "./WizardButtons";
import { useWizardContext } from "./WizardContext";
import { BiCheck } from "react-icons/bi";
import { toast, ToastContainer } from "react-toastify";
import axios from "axios";

const AdditionalInformation = () => {

    const { form } = useWizardContext();

    const [resumeFile, setResumeFile] = useState(null)

    const initialValues = {
        ...form,
        relatedToDirectors: form?.relatedToDirectors || "no",
        name: form?.name || "",
        designation: form?.designation || "",
        convicted: form?.convicted || "no",
        interviewed: form?.interviewed || "no",
        expectedCtc: form?.expectedCtc || "",
        noticePeriod: form?.noticePeriod || "",
        references: form?.references || [
            { serialNo: 1, name: "", company: "", designation: "", capacity: "", contact: "" },
            { serialNo: 2, name: "", company: "", designation: "", capacity: "", contact: "" },
        ],
    };

    const validationSchema = Yup.object().shape({
        relatedToDirectors: Yup.string().required("This field is required"),
        // name: Yup.string().when("relatedToDirectors", {
        //     is: "yes",
        //     then: Yup.string().required("Name is required"),
        // }),
        // designation: Yup.string().when("relatedToDirectors", {
        //     is: "yes",
        //     then: Yup.string().required("Designation is required"),
        // }),
        convicted: Yup.string().required("This field is required"),
        interviewed: Yup.string().required("This field is required"),
        expectedCtc: Yup.number().required("Expected CTC is required"),
        noticePeriod: Yup.string().required("Notice period is required"),
    });

    // Function to convert camelCase keys to snake_case
    const toSnakeCase = (obj) => {
        if (Array.isArray(obj)) {
            return obj.map(toSnakeCase);
        } else if (obj && typeof obj === "object") {
            return Object.keys(obj).reduce((acc, key) => {
                const snakeKey = key.replace(/([A-Z])/g, "_$1").toLowerCase();
                acc[snakeKey] = toSnakeCase(obj[key]);
                return acc;
            }, {});
        }
        return obj;
    };


    // Submit handler
    const handleSubmit = async (values) => {
        console.log('values: ', values);

        try {
            // Convert the object to snake_case
            const snakeCaseData = toSnakeCase(values);

            // Create FormData
            const formData = new FormData();

            // Append form data
            Object.keys(snakeCaseData).forEach((key) => {
                if (Array.isArray(snakeCaseData[key])) {
                    // For arrays, stringify and send
                    formData.append(key, JSON.stringify(snakeCaseData[key]));
                } else {
                    // Append regular fields
                    formData.append(key, snakeCaseData[key]);
                }
            });

            if (resumeFile)
                formData.append("resume_file", resumeFile)

            // Send data to server
            const response = await axios.post("/api/applicant", formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            });

            console.log("Server Response:", response.data);
            // alert("Form submitted successfully!");
            toast.success("Your details have been sent, HR Team will contact you shortly.");
        } catch (error) {
            console.error("Error submitting form:", error.response?.data || error.message);
            // alert("Failed to submit the form. Please try again.");
            toast.error("Failed to submit the form. Please try again.")
        }
    };

    const handleResume = (event) => {
        const [file] = event.target.files

        setResumeFile(file)
    }

    return (
        <Formik
            initialValues={initialValues}
            validationSchema={validationSchema}
            onSubmit={handleSubmit}
        >

            {({ values, errors, touched, handleChange, handleSubmit }) => (
                <FormikForm>
                    <ToastContainer />
                    {
                        resumeFile &&
                        <Alert variant="success" className="d-flex gap-2">
                            <BiCheck />
                            File Uploaded
                        </Alert>
                    }
                    <div className="mb-3">
                        <Form.Label>Upload Resume/CV</Form.Label>
                        <Form.Control type="file" onChange={handleResume} />
                    </div>
                    <div className="mb-3 d-flex justify-content-between align-items-center">
                        <Form.Label>Are you related to any of the Directors/Employees of this organization?</Form.Label>
                        <ToggleButtonGroup
                            type="radio"
                            name="relatedToDirectors"
                            value={values.relatedToDirectors}
                            onChange={(val) => handleChange({ target: { name: "relatedToDirectors", value: val } })}
                        >
                            <ToggleButton id="relatedToDirectors-yes" value="yes">Yes</ToggleButton>
                            <ToggleButton id="relatedToDirectors-no" value="no">No</ToggleButton>
                        </ToggleButtonGroup>
                        {errors.relatedToDirectors && touched.relatedToDirectors && (
                            <div className="text-danger">{errors.relatedToDirectors}</div>
                        )}
                    </div>
                    {values.relatedToDirectors === "yes" && (
                        <Row>
                            <Col className="mb-3">
                                <Form.Label>Name</Form.Label>
                                <Form.Control
                                    type="text"
                                    name="name"
                                    value={values.name}
                                    onChange={handleChange}
                                    isInvalid={touched.name && errors.name}
                                />
                                <Form.Control.Feedback type="invalid">
                                    {errors.name}
                                </Form.Control.Feedback>
                            </Col>
                            <Col className="mb-3">
                                <Form.Label>Designation</Form.Label>
                                <Form.Control
                                    type="text"
                                    name="designation"
                                    value={values.designation}
                                    onChange={handleChange}
                                    isInvalid={touched.designation && errors.designation}
                                />
                                <Form.Control.Feedback type="invalid">
                                    {errors.designation}
                                </Form.Control.Feedback>
                            </Col>
                        </Row>
                    )}

                    <div className="mb-3  d-flex justify-content-between align-items-center">
                        <Form.Label>Have you ever been convicted by any court?</Form.Label>
                        <ToggleButtonGroup
                            type="radio"
                            name="convicted"
                            value={values.convicted}
                            onChange={(val) => handleChange({ target: { name: "convicted", value: val } })}
                        >
                            <ToggleButton id="convicted-yes" value="yes">Yes</ToggleButton>
                            <ToggleButton id="convicted-no" value="no">No</ToggleButton>
                        </ToggleButtonGroup>
                        {errors.convicted && touched.convicted && (
                            <div className="text-danger">{errors.convicted}</div>
                        )}
                    </div>

                    <div className="mb-3 d-flex justify-content-between align-items-center">
                        <Form.Label>Have you ever been interviewed by us?</Form.Label>
                        <ToggleButtonGroup
                            type="radio"
                            name="interviewed"
                            value={values.interviewed}
                            onChange={(val) => handleChange({ target: { name: "interviewed", value: val } })}
                        >
                            <ToggleButton id="interviewed-yes" value="yes">Yes</ToggleButton>
                            <ToggleButton id="interviewed-no" value="no">No</ToggleButton>
                        </ToggleButtonGroup>
                        {errors.interviewed && touched.interviewed && (
                            <div className="text-danger">{errors.interviewed}</div>
                        )}
                    </div>

                    {/* Normal Values */}
                    <div className="mb-3">
                        <Form.Label>Expected CTC per annum</Form.Label>
                        <Form.Control
                            type="number"
                            name="expectedCtc"
                            value={values.expectedCtc}
                            onChange={handleChange}
                            isInvalid={touched.expectedCtc && errors.expectedCtc}
                        />
                        <Form.Control.Feedback type="invalid">
                            {errors.expectedCtc}
                        </Form.Control.Feedback>
                    </div>

                    <div className="mb-3">
                        <Form.Label>Notice Period</Form.Label>
                        <Form.Control
                            type="text"
                            name="noticePeriod"
                            value={values.noticePeriod}
                            onChange={handleChange}
                            isInvalid={touched.noticePeriod && errors.noticePeriod}
                        />
                        <Form.Control.Feedback type="invalid">
                            {errors.noticePeriod}
                        </Form.Control.Feedback>
                    </div>

                    {/* References */}
                    <FieldArray name="references">
                        {({ remove, push }) => (
                            <>
                                <h5>References</h5>
                                <Table bordered>
                                    <thead>
                                        <tr>
                                            <th>S. No.</th>
                                            <th>Name</th>
                                            <th>Company</th>
                                            <th>Designation</th>
                                            <th>Known in capacity of</th>
                                            <th>Contact Number & Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        {values.references.map((ref, index) => (
                                            <tr key={index}>
                                                <td>
                                                    {ref.serialNo}
                                                </td>
                                                <td>
                                                    <Form.Control
                                                        type="text"
                                                        name={`references[${index}].name`}
                                                        value={ref.name}
                                                        onChange={handleChange}
                                                        isInvalid={
                                                            touched.references?.[index]?.name &&
                                                            errors.references?.[index]?.name
                                                        }
                                                    />
                                                    <Form.Control.Feedback type="invalid">
                                                        {errors.references?.[index]?.name}
                                                    </Form.Control.Feedback>
                                                </td>
                                                <td md={6}>
                                                    <Form.Control
                                                        type="text"
                                                        name={`references[${index}].company`}
                                                        value={ref.company}
                                                        onChange={handleChange}
                                                        isInvalid={
                                                            touched.references?.[index]?.company &&
                                                            errors.references?.[index]?.company
                                                        }
                                                    />
                                                    <Form.Control.Feedback type="invalid">
                                                        {errors.references?.[index]?.company}
                                                    </Form.Control.Feedback>
                                                </td>
                                                <td md={6}>
                                                    <Form.Control
                                                        type="text"
                                                        name={`references[${index}].designation`}
                                                        value={ref.designation}
                                                        onChange={handleChange}
                                                        isInvalid={
                                                            touched.references?.[index]?.designation &&
                                                            errors.references?.[index]?.designation
                                                        }
                                                    />
                                                    <Form.Control.Feedback type="invalid">
                                                        {errors.references?.[index]?.designation}
                                                    </Form.Control.Feedback>
                                                </td>
                                                <>
                                                    <td>
                                                        <Form.Control
                                                            type="text"
                                                            name={`references[${index}].capacity`}
                                                            value={ref.capacity}
                                                            onChange={handleChange}
                                                            isInvalid={
                                                                touched.references?.[index]?.capacity &&
                                                                errors.references?.[index]?.capacity
                                                            }
                                                        />
                                                        <Form.Control.Feedback type="invalid">
                                                            {errors.references?.[index]?.capacity}
                                                        </Form.Control.Feedback>
                                                    </td>
                                                    <td>
                                                        <Form.Control
                                                            type="text"
                                                            name={`references[${index}].contact`}
                                                            value={ref.contact}
                                                            onChange={handleChange}
                                                            isInvalid={
                                                                touched.references?.[index]?.contact &&
                                                                errors.references?.[index]?.contact
                                                            }
                                                        />
                                                        <Form.Control.Feedback type="invalid">
                                                            {errors.references?.[index]?.contact}
                                                        </Form.Control.Feedback>
                                                    </td>
                                                </>
                                            </tr>
                                        ))}
                                    </tbody>
                                </Table>
                            </>
                        )}
                    </FieldArray>

                    <WizardButtons />
                </FormikForm>
            )}
        </Formik>
    );
};

export default AdditionalInformation;
