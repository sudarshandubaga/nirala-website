import React from "react";
import { Formik, Form, Field, FieldArray } from "formik";
import * as Yup from "yup";
import { Button, Table, Form as BootstrapForm } from "react-bootstrap";
import WizardButtons from "./WizardButtons";
import { useWizardContext } from "./WizardContext";

const validationSchema = Yup.object().shape({
    records: Yup.array().of(
        Yup.object().shape({
            qualification: Yup.string().required("Qualification is required"),
            yearPassed: Yup.number()
                .required("Year Passed is required")
                .min(1900, "Enter a valid year")
                .max(new Date().getFullYear(), "Year cannot be in the future"),
            institution: Yup.string().required(
                "School/College/Board/University is required"
            ),
            mainSubjects: Yup.string().required("Main Subjects are required"),
            percentage: Yup.string().required("Div or %age is required"),
            achievements: Yup.string().optional(),
        })
    ),
});
const AcademicRecords = () => {
    const { goNext, form } = useWizardContext();
    // Validation schema

    // Initial form values
    const initialValues = {
        records: form?.records || [
            {
                qualification: "",
                yearPassed: "",
                institution: "",
                mainSubjects: "",
                percentage: "",
                achievements: "",
            },
            {
                qualification: "",
                yearPassed: "",
                institution: "",
                mainSubjects: "",
                percentage: "",
                achievements: "",
            },
            {
                qualification: "",
                yearPassed: "",
                institution: "",
                mainSubjects: "",
                percentage: "",
                achievements: "",
            },
        ],
    };

    return (
        <Formik
            initialValues={initialValues}
            validationSchema={validationSchema}
            onSubmit={(values) => {
                console.log("Submitted Data", values);

                goNext(values)
            }}
        >
            {({ values, errors, touched, handleChange }) => (
                <Form>
                    <FieldArray name="records">
                        {({ insert, remove, push }) => (
                            <>
                                <Table bordered hover>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Qualification</th>
                                            <th>Year Passed</th>
                                            <th>School/College/Board/University</th>
                                            <th>Main Subjects</th>
                                            <th>Div or %age</th>
                                            <th>Awards/Achievements</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {values.records.map((record, index) => (
                                            <tr key={index}>
                                                <td>{index + 1}</td>
                                                <td>
                                                    <Field
                                                        name={`records.${index}.qualification`}
                                                        className={`form-control ${errors.records?.[index]?.qualification &&
                                                            touched.records?.[index]?.qualification
                                                            ? "is-invalid"
                                                            : ""
                                                            }`}
                                                    />
                                                    {errors.records?.[index]?.qualification &&
                                                        touched.records?.[index]?.qualification && (
                                                            <div className="invalid-feedback">
                                                                {errors.records[index].qualification}
                                                            </div>
                                                        )}
                                                </td>
                                                <td>
                                                    <Field
                                                        name={`records.${index}.yearPassed`}
                                                        type="number"
                                                        className={`form-control ${errors.records?.[index]?.yearPassed &&
                                                            touched.records?.[index]?.yearPassed
                                                            ? "is-invalid"
                                                            : ""
                                                            }`}
                                                    />
                                                    {errors.records?.[index]?.yearPassed &&
                                                        touched.records?.[index]?.yearPassed && (
                                                            <div className="invalid-feedback">
                                                                {errors.records[index].yearPassed}
                                                            </div>
                                                        )}
                                                </td>
                                                <td>
                                                    <Field
                                                        name={`records.${index}.institution`}
                                                        className={`form-control ${errors.records?.[index]?.institution &&
                                                            touched.records?.[index]?.institution
                                                            ? "is-invalid"
                                                            : ""
                                                            }`}
                                                    />
                                                    {errors.records?.[index]?.institution &&
                                                        touched.records?.[index]?.institution && (
                                                            <div className="invalid-feedback">
                                                                {errors.records[index].institution}
                                                            </div>
                                                        )}
                                                </td>
                                                <td>
                                                    <Field
                                                        name={`records.${index}.mainSubjects`}
                                                        className={`form-control ${errors.records?.[index]?.mainSubjects &&
                                                            touched.records?.[index]?.mainSubjects
                                                            ? "is-invalid"
                                                            : ""
                                                            }`}
                                                    />
                                                    {errors.records?.[index]?.mainSubjects &&
                                                        touched.records?.[index]?.mainSubjects && (
                                                            <div className="invalid-feedback">
                                                                {errors.records[index].mainSubjects}
                                                            </div>
                                                        )}
                                                </td>
                                                <td>
                                                    <Field
                                                        name={`records.${index}.percentage`}
                                                        className={`form-control ${errors.records?.[index]?.percentage &&
                                                            touched.records?.[index]?.percentage
                                                            ? "is-invalid"
                                                            : ""
                                                            }`}
                                                    />
                                                    {errors.records?.[index]?.percentage &&
                                                        touched.records?.[index]?.percentage && (
                                                            <div className="invalid-feedback">
                                                                {errors.records[index].percentage}
                                                            </div>
                                                        )}
                                                </td>
                                                <td>
                                                    <Field
                                                        name={`records.${index}.achievements`}
                                                        className="form-control"
                                                    />
                                                </td>
                                                <td>
                                                    <Button
                                                        variant="danger"
                                                        onClick={() => remove(index)}
                                                    >
                                                        Remove
                                                    </Button>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </Table>
                                <Button
                                    variant="primary"
                                    onClick={() =>
                                        push({
                                            qualification: "",
                                            yearPassed: "",
                                            institution: "",
                                            mainSubjects: "",
                                            percentage: "",
                                            achievements: "",
                                        })
                                    }
                                >
                                    Add Row
                                </Button>
                            </>
                        )}
                    </FieldArray>
                    <div className="mt-3">
                        <WizardButtons />
                    </div>
                </Form>
            )}
        </Formik>
    );
};

export default AcademicRecords;
