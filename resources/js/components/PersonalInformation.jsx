import React from 'react';
import { Formik, Form, Field, ErrorMessage } from 'formik';
import * as Yup from 'yup';
import { Container, Form as BootstrapForm, Button, Row, Col } from 'react-bootstrap';
import WizardButtons from './WizardButtons';
import ImagePicker from './ImagePicker';

const MaritalStatusOptions = ['Bachelor', 'Married', 'Other'];
const VehicleTypeOptions = ['2 Wheeler', '4 Wheeler'];

const validationSchema = Yup.object({
    fullName: Yup.string()
        .required('Full Name is required')
        .min(3, 'Full Name must be at least 3 characters long'),
    fatherOrHusbandName: Yup.string()
        .required('Father / Husband Name is required')
        .min(3, 'Name must be at least 3 characters long'),
    currentAddress: Yup.string()
        .required('Current Address is required')
        .min(10, 'Address must be at least 10 characters long'),
    dateOfBirth: Yup.date()
        .required('Date of Birth is required')
        .max(new Date(), 'Date of Birth cannot be in the future'),
    placeOfBirth: Yup.string()
        .required('Place of Birth is required')
        .min(3, 'Place of Birth must be at least 3 characters long'),
    maritalStatus: Yup.string()
        .required('Marital Status is required')
        .oneOf(MaritalStatusOptions, 'Invalid Marital Status'),
    email: Yup.string()
        .required('Email ID is required')
        .email('Invalid Email format'),
    phoneNumber: Yup.string()
        .required('Phone Number is required')
        .matches(/^\d{10}$/, 'Phone Number must be 10 digits'),
    spouseName: Yup.string()
        .when('maritalStatus', {
            is: 'Married',
            then: Yup.string().required('Spouse’s Name is required'),
            otherwise: Yup.string(),
        }),
    occupation: Yup.string()
        .required('Occupation is required'),
    nationality: Yup.string()
        .required('Nationality is required'),
    vehicleType: Yup.string()
        .required('Vehicle Type is required')
        .oneOf(VehicleTypeOptions, 'Invalid Vehicle Type'),
});

const PersonalInformation = () => {
    return (
        <Formik
            initialValues={{
                fullName: '',
                fatherOrHusbandName: '',
                currentAddress: '',
                dateOfBirth: '',
                placeOfBirth: '',
                maritalStatus: '',
                email: '',
                phoneNumber: '',
                spouseName: '',
                occupation: '',
                nationality: 'Indian',
                vehicleType: '',
                image: null,
                sign: null,
            }}
            validationSchema={validationSchema}
            onSubmit={(values) => {
                alert(JSON.stringify(values, null, 2));
            }}
        >
            {({ handleSubmit, values, setFieldValue }) => (
                <Form onSubmit={handleSubmit} as={BootstrapForm}>
                    <Row className="mb-3">
                        <Col md={8}>
                            <Row>
                                <Col md={6} className="mb-3">
                                    <BootstrapForm.Group>
                                        <BootstrapForm.Label>Full Name</BootstrapForm.Label>
                                        <Field
                                            name="fullName"
                                            as={BootstrapForm.Control}
                                            type="text"
                                            placeholder="Enter your full name"
                                        />
                                        <ErrorMessage name="fullName" component="div" className="text-danger" />
                                    </BootstrapForm.Group>
                                </Col>
                                <Col md={6} className="mb-3">
                                    <BootstrapForm.Group>
                                        <BootstrapForm.Label>Father / Husband Name</BootstrapForm.Label>
                                        <Field
                                            name="fatherOrHusbandName"
                                            as={BootstrapForm.Control}
                                            type="text"
                                            placeholder="Enter Father / Husband name"
                                        />
                                        <ErrorMessage name="fatherOrHusbandName" component="div" className="text-danger" />
                                    </BootstrapForm.Group>
                                </Col>
                            </Row>

                            <Row>
                                <Col className="mb-3">
                                    <BootstrapForm.Group>
                                        <BootstrapForm.Label>Current Address</BootstrapForm.Label>
                                        <Field
                                            name="currentAddress"
                                            as="textarea"
                                            rows={3}
                                            placeholder="Enter your current address"
                                            className="form-control"
                                        />
                                        <ErrorMessage name="currentAddress" component="div" className="text-danger" />
                                    </BootstrapForm.Group>
                                </Col>
                            </Row>

                            <Row>
                                <Col md={4} className="mb-3">
                                    <BootstrapForm.Group>
                                        <BootstrapForm.Label>Date of Birth</BootstrapForm.Label>
                                        <Field name="dateOfBirth" as={BootstrapForm.Control} type="date" />
                                        <ErrorMessage name="dateOfBirth" component="div" className="text-danger" />
                                    </BootstrapForm.Group>
                                </Col>
                                <Col md={4} className="mb-3">
                                    <BootstrapForm.Group>
                                        <BootstrapForm.Label>Place of Birth</BootstrapForm.Label>
                                        <Field
                                            name="placeOfBirth"
                                            as={BootstrapForm.Control}
                                            type="text"
                                            placeholder="Enter place of birth"
                                        />
                                        <ErrorMessage name="placeOfBirth" component="div" className="text-danger" />
                                    </BootstrapForm.Group>
                                </Col>
                                <Col md={4} className="mb-3">
                                    <BootstrapForm.Group>
                                        <BootstrapForm.Label>Marital Status</BootstrapForm.Label>
                                        <Field name="maritalStatus" as={BootstrapForm.Select} className="form-control">
                                            <option value="">Select Marital Status</option>
                                            {MaritalStatusOptions.map((status) => (
                                                <option key={status} value={status}>
                                                    {status}
                                                </option>
                                            ))}
                                        </Field>
                                        <ErrorMessage name="maritalStatus" component="div" className="text-danger" />
                                    </BootstrapForm.Group>
                                </Col>
                            </Row>

                            {values.maritalStatus === 'Married' && (
                                <Row>
                                    <Col md={6} className="mb-3">
                                        <BootstrapForm.Group>
                                            <BootstrapForm.Label>Spouse’s Name</BootstrapForm.Label>
                                            <Field
                                                name="spouseName"
                                                as={BootstrapForm.Control}
                                                type="text"
                                                placeholder="Enter Spouse’s Name"
                                            />
                                            <ErrorMessage name="spouseName" component="div" className="text-danger" />
                                        </BootstrapForm.Group>
                                    </Col>
                                </Row>
                            )}

                            <Row>
                                <Col md={6} className="mb-3">
                                    <BootstrapForm.Group>
                                        <BootstrapForm.Label>Email ID</BootstrapForm.Label>
                                        <Field
                                            name="email"
                                            as={BootstrapForm.Control}
                                            type="email"
                                            placeholder="Enter your email"
                                        />
                                        <ErrorMessage name="email" component="div" className="text-danger" />
                                    </BootstrapForm.Group>
                                </Col>
                                <Col md={6} className="mb-3">
                                    <BootstrapForm.Group>
                                        <BootstrapForm.Label>Phone Number</BootstrapForm.Label>
                                        <Field
                                            name="phoneNumber"
                                            as={BootstrapForm.Control}
                                            type="text"
                                            placeholder="Enter your phone number"
                                        />
                                        <ErrorMessage name="phoneNumber" component="div" className="text-danger" />
                                    </BootstrapForm.Group>
                                </Col>
                            </Row>

                            <Row>
                                <Col md={6} className="mb-3">
                                    <BootstrapForm.Group>
                                        <BootstrapForm.Label>Occupation</BootstrapForm.Label>
                                        <Field
                                            name="occupation"
                                            as={BootstrapForm.Control}
                                            type="text"
                                            placeholder="Enter your occupation"
                                        />
                                        <ErrorMessage name="occupation" component="div" className="text-danger" />
                                    </BootstrapForm.Group>
                                </Col>
                                <Col md={6} className="mb-3">
                                    <BootstrapForm.Group>
                                        <BootstrapForm.Label>Nationality</BootstrapForm.Label>
                                        <Field
                                            name="nationality"
                                            as={BootstrapForm.Control}
                                            type="text"
                                            placeholder="Enter your nationality"
                                        />
                                        <ErrorMessage name="nationality" component="div" className="text-danger" />
                                    </BootstrapForm.Group>
                                </Col>
                            </Row>

                            <Row>
                                <Col md={6} className="mb-3">
                                    <BootstrapForm.Group>
                                        <BootstrapForm.Label>Vehicle Type</BootstrapForm.Label>
                                        <Field name="vehicleType" as={BootstrapForm.Select} className="form-control">
                                            <option value="">Select Vehicle Type</option>
                                            {VehicleTypeOptions.map((type) => (
                                                <option key={type} value={type}>
                                                    {type}
                                                </option>
                                            ))}
                                        </Field>
                                        <ErrorMessage name="vehicleType" component="div" className="text-danger" />
                                    </BootstrapForm.Group>
                                </Col>
                            </Row>
                        </Col>
                        <Col md={4}>
                            <div className="mb-3">
                                <BootstrapForm.Label>Upload Photograph</BootstrapForm.Label>
                                <ImagePicker done={(image) => setFieldValue("image", image)} image={values.image} width={350} height={450} />
                            </div>
                            <div className="mb-3">
                                <BootstrapForm.Label>Upload Signature</BootstrapForm.Label>
                                <ImagePicker done={(sign) => setFieldValue("sign", sign)} image={values.sign} width={500} height={200} />
                            </div>
                        </Col>
                    </Row>

                    <WizardButtons />
                </Form>
            )}
        </Formik>
    );
};

export default PersonalInformation;
