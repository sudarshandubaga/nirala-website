import React, { useRef, useState } from 'react';
import { Formik, Form, Field, FieldArray, ErrorMessage } from 'formik';
import * as Yup from 'yup';
import { Button, Table, Modal, FormControl, FormLabel, Col, Row } from 'react-bootstrap';
import WizardButtons from './WizardButtons';
import moment from 'moment';
import { CgClose } from 'react-icons/cg';
import { useWizardContext } from './WizardContext';

const Employment = () => {
    const [showModal, setShowModal] = useState(false);
    const [editData, setEditData] = useState(null);
    const { goNext, form } = useWizardContext();

    const formikRef = useRef(null)

    const initialValues = {
        professionalMembership: form?.professionalMembership || [
            { organization: '', dateSince: '', contribution: '' },
        ],
        employmentHistory: form?.employmentHistory || [],
    };

    const validationSchema = Yup.object().shape({
        employmentHistory: Yup.array().of(
            Yup.object().shape({
                from: Yup.string().required('Required'),
                to: Yup.string().required('Required'),
                employer: Yup.string().required('Required'),
                designationOnJoining: Yup.string().required('Required'),
                designationOnLeaving: Yup.string().required('Required'),
                jobDescription: Yup.string().required('Required'),
                salaryOnJoining: Yup.number().required('Required'),
                salaryOnLeaving: Yup.number().required('Required'),
                reasonOfLeaving: Yup.string().required('Required'),
            })
        ).min(1, 'At least one employment history record is required'),
    });

    const handleShowModal = (editValues = null) => {
        setEditData(editValues);
        setShowModal(true);
    };

    const handleCloseModal = () => {
        setShowModal(false);
        setEditData(null);
    };

    return (
        <>
            <Formik
                initialValues={initialValues}
                validationSchema={validationSchema}
                onSubmit={(values) => {
                    goNext(values);
                }}
                innerRef={formikRef}
            >
                {({ values, errors, touched, setFieldValue }) => (
                    <Form>
                        <h4>Professional Membership</h4>
                        <FieldArray name="professionalMembership">
                            {({ remove, push }) => (
                                <div className='mb-5'>
                                    <Button
                                        variant="success"
                                        className='mb-3'
                                        onClick={() => push({ organization: '', dateSince: '', contribution: '' })}
                                    >
                                        Add Record
                                    </Button>
                                    <Table bordered>
                                        <thead>
                                            <tr>
                                                <th>Organization/Association</th>
                                                <th>Date Since</th>
                                                <th>Contribution</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {values?.professionalMembership?.map((_, index) => (
                                                <tr key={index} className="mb-3">
                                                    <td md={4}>
                                                        <Field
                                                            name={`professionalMembership.${index}.organization`}
                                                            placeholder="Organization/Association"
                                                            className="form-control"
                                                        />
                                                        {touched.professionalMembership &&
                                                            errors.professionalMembership &&
                                                            errors.professionalMembership[index]?.organization && (
                                                                <div className="text-danger">
                                                                    {errors.professionalMembership[index]?.organization}
                                                                </div>
                                                            )}
                                                    </td>
                                                    <td md={3}>
                                                        <Field
                                                            name={`professionalMembership.${index}.dateSince`}
                                                            placeholder="Date Since"
                                                            type="date"
                                                            className="form-control"
                                                        />
                                                    </td>
                                                    <td md={3}>
                                                        <Field
                                                            name={`professionalMembership.${index}.contribution`}
                                                            placeholder="Contribution"
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
                                </div>
                            )}
                        </FieldArray>
                        <h4>Employment History</h4>
                        <Button variant="success" onClick={() => handleShowModal()} className='mb-3'>
                            Add Employment History
                        </Button>
                        <ErrorMessage name='employmentHistory' component="div" className="text-danger" />
                        <Table bordered>
                            <thead className="text-center">
                                <tr>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Employer</th>
                                    <th>Designation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {values?.employmentHistory?.map((record, index) => (
                                    <tr key={index}>
                                        <td>{record.from || '-'}</td>
                                        <td>{record.to || '-'}</td>
                                        <td>{record.employer || '-'}</td>
                                        <td>
                                            {record.designationOnJoining} / {record.designationOnLeaving}
                                        </td>
                                        <td>
                                            <Button variant="primary" size="sm" onClick={() => handleShowModal(record)}>
                                                Edit
                                            </Button>{' '}
                                            <Button
                                                variant="danger"
                                                size="sm"
                                                onClick={() =>
                                                    setFieldValue(
                                                        'employmentHistory',
                                                        values.employmentHistory.filter((_, i) => i !== index)
                                                    )
                                                }
                                            >
                                                Remove
                                            </Button>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </Table>
                        <WizardButtons />
                    </Form>
                )}
            </Formik>
            <Modal show={showModal} onHide={handleCloseModal} scrollable centered>
                <Modal.Header>
                    <Modal.Title>
                        {editData !== null ? 'Edit Employment History' : 'Add Employment History'}
                    </Modal.Title>
                    <button type='button' onClick={handleCloseModal} style={{
                        backgroundColor: 'transparent',
                        padding: 0,
                        border: 0,
                        margin: 0
                    }}>
                        <CgClose size={30} color='#fff' />
                    </button>
                </Modal.Header>
                <Modal.Body>
                    <Formik initialValues={editData !== null
                        ? editData
                        : {
                            from: '',
                            to: '',
                            employer: '',
                            designationOnJoining: '',
                            designationOnLeaving: '',
                            jobDescription: '',
                            salaryOnJoining: '',
                            salaryOnLeaving: '',
                            reasonOfLeaving: '',
                        }} onSubmit={(values, { resetForm }) => {
                            const { values: allValues, setFieldValue } = formikRef.current

                            console.log('====================================');
                            console.log('values: ', values, allValues);
                            console.log('====================================');


                            setFieldValue("employmentHistory", [...allValues.employmentHistory, values])
                            resetForm()

                            handleCloseModal();
                        }}>
                        {
                            () => (
                                <Form>
                                    <>
                                        <Row>
                                            <Col className="mb-3">
                                                <FormLabel>From Date</FormLabel>
                                                <Field
                                                    name={`from`}
                                                    placeholder="From"
                                                    type="date"
                                                    as={FormControl}
                                                    size="sm"
                                                    max={moment(new Date()).format("YYYY-MM-DD")}
                                                />
                                                <ErrorMessage name='from' component="div" className='text-danger' />
                                            </Col>
                                            <Col className="mb-3">
                                                <FormLabel>To Date</FormLabel>
                                                <Field
                                                    name={`to`}
                                                    placeholder="To"
                                                    type="date"
                                                    as={FormControl}
                                                    size="sm"
                                                    max={moment(new Date()).format("YYYY-MM-DD")}
                                                />
                                                <ErrorMessage name='to' component="div" className='text-danger' />
                                            </Col>

                                        </Row>
                                        <div className="mb-3">
                                            <FormLabel>Employer Name & Address</FormLabel>
                                            <Field
                                                name={`employer`}
                                                placeholder="Employer Name & Address"
                                                as="textarea"
                                                rows={3}
                                                className="form-control"
                                            />
                                            <ErrorMessage name='employer' component="div" className='text-danger' />
                                        </div>
                                        <Row className='align-items-center'>
                                            <Col className='mb-3' md={3}>Designation</Col>
                                            <Col className='mb-3'>
                                                <FormLabel>On Joining</FormLabel>
                                                <Field
                                                    name={`designationOnJoining`}
                                                    className="form-control"
                                                />
                                                <ErrorMessage name='designationOnJoining' component="div" className='text-danger' />
                                            </Col>
                                            <Col className='mb-3'>
                                                <FormLabel>On Leaving</FormLabel>
                                                <Field
                                                    name={`designationOnLeaving`}
                                                    className="form-control"
                                                />
                                                <ErrorMessage name='designationOnLeaving' component="div" className='text-danger' />
                                            </Col>
                                        </Row>
                                        <div className="mb-3">
                                            <FormLabel>Job Description</FormLabel>
                                            <Field
                                                name={`jobDescription`}
                                                placeholder="Job Description"
                                                as="textarea"
                                                rows={3}
                                                className="form-control"
                                            />
                                            <ErrorMessage name='jobDescription' component="div" className='text-danger' />
                                        </div>

                                        <Row className='align-items-center'>
                                            <Col className='mb-3' md={3}>Salary</Col>
                                            <Col className='mb-3'>
                                                <FormLabel>On Joining</FormLabel>
                                                <Field
                                                    name={`salaryOnJoining`}
                                                    placeholder="Salary on Joining"
                                                    type="number"
                                                    className="form-control"
                                                />
                                                <ErrorMessage name='salaryOnJoining' component="div" className='text-danger' />
                                            </Col>
                                            <Col className='mb-3'>
                                                <FormLabel>On Leaving</FormLabel>
                                                <Field
                                                    name={`salaryOnLeaving`}
                                                    placeholder="Salary on Leaving"
                                                    type="number"
                                                    className="form-control"
                                                />
                                                <ErrorMessage name='salaryOnLeaving' component="div" className='text-danger' />
                                            </Col>
                                        </Row>

                                        <div className="mb-3">
                                            <FormLabel>Reason of Leavining</FormLabel>
                                            <Field
                                                name={`reasonOfLeaving`}
                                                placeholder="Reason of Leaving"
                                                className="form-control"
                                            />
                                            <ErrorMessage name='reasonOfLeaving' component="div" className='text-danger' />
                                        </div>

                                        <div className="mt-3 text-right">
                                            <button
                                                type='submit'
                                                className='site-button'
                                            >
                                                Save
                                            </button>
                                        </div>
                                    </>
                                </Form>
                            )
                        }
                    </Formik>
                </Modal.Body>
            </Modal>
        </>
    );
};

export default Employment;
