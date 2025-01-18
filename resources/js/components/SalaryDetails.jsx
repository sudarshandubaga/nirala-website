import React, { Fragment } from 'react';
import { Table, Form, Button, Row, Col } from 'react-bootstrap';
import { Formik, Field, ErrorMessage } from 'formik';
import * as Yup from 'yup';
import WizardButtons from './WizardButtons';
import { useWizardContext } from './WizardContext';

const validationSchema = Yup.object({
    particulars: Yup.array()
        .of(
            Yup.object({
                amount: Yup.number()
                    .typeError('Must be a number')
                    .required('Required'),
                remarks: Yup.string().required('Required'),
            })
        )
        .required('Required'),
});

const SalaryDetails = () => {

    const { goNext, form } = useWizardContext();
    const initialValues = {
        particulars: form?.particulars || [
            {
                title: "Remuneration",
                items: [
                    { name: 'Basic Salary', amount: '', remarks: '' },
                    { name: 'DA', amount: '', remarks: '' },
                    { name: 'Other Allowance', amount: '', remarks: '' },
                ]
            },
            {
                title: "Residence",
                items: [
                    { name: 'Free accommodation', amount: '', remarks: '' },
                    { name: 'Free furnished/semi furnished', amount: '', remarks: '' },
                    { name: 'HRA', amount: '', remarks: '' },
                    { name: 'Telephone Subsidy', amount: '', remarks: '' },
                ]
            },
            {
                title: "Conveyance",
                items: [

                    { name: 'Company Car', amount: '', remarks: '' },
                    { name: 'Conveyance Allowance', amount: '', remarks: '' },
                    { name: 'Conveyance Reimbursement', amount: '', remarks: '' },
                ]
            },
            {
                title: "Others",
                items: [
                    { name: 'Medical Subsidy/Allowance', amount: '', remarks: '' },
                    { name: 'Leave Travel Allowance', amount: '', remarks: '' },
                    { name: 'Bonus/Ex Gratia', amount: '', remarks: '' },
                ]
            },
            {
                title: "Retirement benefits",
                items: [
                    { name: 'Contributory P.F.', amount: '', remarks: '' },
                    { name: 'Gratuity', amount: '', remarks: '' },
                    { name: 'Superannuation', amount: '', remarks: '' },
                ]
            }
        ],
    };

    const handleSubmit = (values) => {
        goNext(values)
    };

    return (
        <Formik
            initialValues={initialValues}
            validationSchema={validationSchema}
            onSubmit={handleSubmit}
        >
            {({ values, handleSubmit }) => (
                <Form noValidate onSubmit={handleSubmit}>
                    <Table bordered>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Particulars</th>
                                <th>Amount per month</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            {
                                values.particulars.map((part, partIndex) => (
                                    <Fragment key={partIndex}>
                                        {part.items.map((item, index) => (
                                            <tr key={index}>
                                                {
                                                    index == 0 &&
                                                    <td rowSpan={part.items.length}>{part.title}</td>
                                                }
                                                <td>{item.name}</td>
                                                <td>
                                                    <Field
                                                        name={`particulars[${index}].amount`}
                                                        className="form-control"
                                                    />
                                                    <ErrorMessage
                                                        name={`particulars[${index}].amount`}
                                                        component="div"
                                                        className="text-danger"
                                                    />
                                                </td>
                                                <td>
                                                    <Field
                                                        name={`particulars[${index}].remarks`}
                                                        className="form-control"
                                                    />
                                                    <ErrorMessage
                                                        name={`particulars[${index}].remarks`}
                                                        component="div"
                                                        className="text-danger"
                                                    />
                                                </td>
                                            </tr>
                                        ))}
                                    </Fragment>
                                ))
                            }
                            <tr>
                                <td colSpan={2} className="text-end fw-bold">
                                    TOTAL
                                </td>
                                <td>
                                    <span className="fw-bold">
                                        {values.particulars.reduce(
                                            (sum, item) => sum + (parseFloat(item.amount) || 0),
                                            0
                                        )}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </Table>
                    <WizardButtons />
                </Form>
            )}
        </Formik>
    );
};

export default SalaryDetails;
