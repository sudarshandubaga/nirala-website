import React, { useState } from 'react';
import { Formik, Form, Field, FieldArray } from 'formik';
import * as Yup from 'yup';
import { Button, Table, Modal, FormControl, FormLabel, Col, Row } from 'react-bootstrap';
import WizardButtons from './WizardButtons';
import moment from 'moment';
import { CgClose } from 'react-icons/cg';

const Employment = () => {
    const [showModal, setShowModal] = useState(false);
    const [currentIndex, setCurrentIndex] = useState(null);

    const initialValues = {
        professionalMembership: [
            { organization: '', dateSince: '', contribution: '' },
        ],
        employmentHistory: [
            {
                from: '',
                to: '',
                employer: '',
                designationOnJoining: '',
                designationOnLeaving: '',
                jobDescription: '',
                salaryOnJoining: '',
                salaryOnLeaving: '',
                reasonOfLeaving: '',
            },
        ],
        positionDetails: {
            position: '',
            reportingTo: '',
        },
    };

    const validationSchema = Yup.object().shape({
        professionalMembership: Yup.array().of(
            Yup.object().shape({
                organization: Yup.string().required('Required'),
                dateSince: Yup.string().required('Required'),
                contribution: Yup.string().required('Required'),
            })
        ),
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
        ),
        positionDetails: Yup.object().shape({
            position: Yup.string().required('Required'),
            reportingTo: Yup.string().required('Required'),
        }),
    });

    const handleShowModal = (index = null) => {
        setCurrentIndex(index);
        setShowModal(true);
    };

    const handleCloseModal = () => {
        setShowModal(false);
        setCurrentIndex(null);
    };

    return (
        <Formik
            initialValues={initialValues}
            validationSchema={validationSchema}
            onSubmit={(values) => {
                console.log(values);
                alert('Form submitted successfully!');
            }}
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
                                    {values.professionalMembership.map((_, index) => (
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
                                </Table>
                            </div>
                        )}
                    </FieldArray>
                    <h4>Employment History</h4>
                    <Button variant="success" onClick={() => handleShowModal()} className='mb-3'>
                        Add Employment History
                    </Button>
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
                            {values.employmentHistory.map((record, index) => (
                                <tr key={index}>
                                    <td>{record.from || '-'}</td>
                                    <td>{record.to || '-'}</td>
                                    <td>{record.employer || '-'}</td>
                                    <td>
                                        {record.designationOnJoining} / {record.designationOnLeaving}
                                    </td>
                                    <td>
                                        <Button variant="primary" size="sm" onClick={() => handleShowModal(index)}>
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

                    <Modal show={showModal} onHide={handleCloseModal} scrollable centered>
                        <Modal.Header>
                            <Modal.Title>
                                {currentIndex !== null ? 'Edit Employment History' : 'Add Employment History'}
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
                            <FieldArray name="employmentHistory">
                                {({ push, remove }) => {
                                    const record =
                                        currentIndex !== null
                                            ? values.employmentHistory[currentIndex]
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
                                            };

                                    return (
                                        <>
                                            <Row>
                                                <Col className="mb-3">
                                                    <FormLabel>From Date</FormLabel>
                                                    <Field
                                                        name={`employmentHistory.${currentIndex}.from`}
                                                        placeholder="From"
                                                        type="date"
                                                        as={FormControl}
                                                        size="sm"
                                                        max={moment(new Date()).format("YYYY-MM-DD")}
                                                    />
                                                </Col>
                                                <Col className="mb-3">
                                                    <FormLabel>To Date</FormLabel>
                                                    <Field
                                                        name={`employmentHistory.${currentIndex}.to`}
                                                        placeholder="To"
                                                        type="date"
                                                        as={FormControl}
                                                        size="sm"
                                                        max={moment(new Date()).format("YYYY-MM-DD")}
                                                    />
                                                </Col>

                                            </Row>
                                            <div className="mb-3">
                                                <FormLabel>Employer Name & Address</FormLabel>
                                                <Field
                                                    name={`employmentHistory.${currentIndex}.employer`}
                                                    placeholder="Employer Name & Address"
                                                    as="textarea"
                                                    rows={3}
                                                    className="form-control"
                                                />
                                            </div>
                                            <Row className='align-items-center'>
                                                <Col className='mb-3' md={3}>Designation</Col>
                                                <Col className='mb-3'>
                                                    <FormLabel>On Joining</FormLabel>
                                                    <Field
                                                        name={`employmentHistory.${currentIndex}.designationOnJoining`}
                                                        className="form-control"
                                                    />
                                                </Col>
                                                <Col className='mb-3'>
                                                    <FormLabel>On Leaving</FormLabel>
                                                    <Field
                                                        name={`employmentHistory.${currentIndex}.designationOnLeaving`}
                                                        className="form-control"
                                                    />
                                                </Col>
                                            </Row>
                                            <div className="mb-3">
                                                <FormLabel>Job Description</FormLabel>
                                                <Field
                                                    name={`employmentHistory.${currentIndex}.jobDescription`}
                                                    placeholder="Job Description"
                                                    as="textarea"
                                                    rows={3}
                                                    className="form-control"
                                                />
                                            </div>

                                            <Row className='align-items-center'>
                                                <Col className='mb-3' md={3}>Salary</Col>
                                                <Col className='mb-3'>
                                                    <FormLabel>On Joining</FormLabel>
                                                    <Field
                                                        name={`employmentHistory.${currentIndex}.salaryOnJoining`}
                                                        placeholder="Salary on Joining"
                                                        type="number"
                                                        className="form-control"
                                                    />
                                                </Col>
                                                <Col className='mb-3'>
                                                    <FormLabel>On Leaving</FormLabel>
                                                    <Field
                                                        name={`employmentHistory.${currentIndex}.salaryOnLeaving`}
                                                        placeholder="Salary on Leaving"
                                                        type="number"
                                                        className="form-control"
                                                    />
                                                </Col>
                                            </Row>

                                            <div className="mb-3">
                                                <FormLabel>Reason of Leavining</FormLabel>
                                                <Field
                                                    name={`employmentHistory.${currentIndex}.reasonOfLeaving`}
                                                    placeholder="Reason of Leaving"
                                                    className="form-control"
                                                />
                                            </div>

                                            <div className="mt-3 text-right">
                                                <button
                                                    type='button'
                                                    className='site-button'
                                                    onClick={() => {
                                                        if (currentIndex !== null) {
                                                            setFieldValue(
                                                                `employmentHistory.${currentIndex}`,
                                                                record
                                                            );
                                                        } else {
                                                            push(record);
                                                        }
                                                        handleCloseModal();
                                                    }}
                                                >
                                                    Save
                                                </button>
                                            </div>
                                        </>
                                    );
                                }}
                            </FieldArray>
                        </Modal.Body>
                    </Modal>

                    <WizardButtons />
                </Form>
            )}
        </Formik>
    );
};

export default Employment;
