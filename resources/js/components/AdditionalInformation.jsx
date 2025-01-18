import React from "react";
import { Form, Row, Col, ToggleButton, ToggleButtonGroup, Table } from "react-bootstrap";
import { Formik, FieldArray } from "formik";
import * as Yup from "yup";
import WizardButtons from "./WizardButtons";
import { useWizardContext } from "./WizardContext";

const AdditionalInformation = () => {

    const { form } = useWizardContext();

    const initialValues = {
        ...form,
        relatedToDirectors: "no",
        name: "",
        designation: "",
        convicted: "no",
        interviewed: "no",
        expectedCTC: "",
        noticePeriod: "",
        references: [
            { serialNo: 1, name: "", company: "", designation: "", capacity: "", contact: "" },
            { serialNo: 2, name: "", company: "", designation: "", capacity: "", contact: "" },
        ],
    };

    const validationSchema = Yup.object().shape({
        relatedToDirectors: Yup.string().required("This field is required"),
        name: Yup.string().when("relatedToDirectors", {
            is: "yes",
            then: Yup.string().required("Name is required"),
        }),
        designation: Yup.string().when("relatedToDirectors", {
            is: "yes",
            then: Yup.string().required("Designation is required"),
        }),
        convicted: Yup.string().required("This field is required"),
        interviewed: Yup.string().required("This field is required"),
        expectedCTC: Yup.number().required("Expected CTC is required"),
        noticePeriod: Yup.string().required("Notice period is required"),
        references: Yup.array().of(
            Yup.object().shape({
                name: Yup.string().required("Name is required"),
                company: Yup.string().required("Company is required"),
                designation: Yup.string().required("Designation is required"),
                capacity: Yup.string().required("Capacity is required"),
                contact: Yup.string().required("Contact details are required"),
            })
        ),
    });

    const handleSubmit = (values) => {
        console.log(values);
    };

    return (
        <Formik
            initialValues={initialValues}
            validationSchema={validationSchema}
            onSubmit={handleSubmit}
        >
            {({ values, errors, touched, handleChange, handleSubmit }) => (
                <Form onSubmit={handleSubmit}>
                    {/* Yes/No Toggle Questions */}
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
                            name="expectedCTC"
                            value={values.expectedCTC}
                            onChange={handleChange}
                            isInvalid={touched.expectedCTC && errors.expectedCTC}
                        />
                        <Form.Control.Feedback type="invalid">
                            {errors.expectedCTC}
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
                </Form>
            )}
        </Formik>
    );
};

export default AdditionalInformation;
