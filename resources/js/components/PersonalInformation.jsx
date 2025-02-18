import React, { useCallback, useEffect, useState } from 'react';
import { Formik, Form, Field, ErrorMessage } from 'formik';
import * as Yup from 'yup';
import { Form as BootstrapForm, Row, Col } from 'react-bootstrap';
import WizardButtons from './WizardButtons';
import ImagePicker from './ImagePicker';
import { useWizardContext } from './WizardContext';
import moment from 'moment';
import axios from 'axios';

const MaritalStatusOptions = ['Unmarried', 'Married'];
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
    permanentAddress: Yup.string()
        .required('Current Address is required')
        .min(10, 'Address must be at least 10 characters long'),
    dateOfBirth: Yup.date()
        .required('Date of Birth is required')
        .max(new Date(), 'Date of Birth cannot be in the future'),
    maritalStatus: Yup.string()
        .required('Marital Status is required')
        .oneOf(MaritalStatusOptions, 'Invalid Marital Status'),
    email: Yup.string()
        .required('Email ID is required')
        .email('Invalid Email format'),
    phoneNumber: Yup.string()
        .required('Phone Number is required')
        .matches(/^\d{10}$/, 'Phone Number must be 10 digits'),
    altMobileNo: Yup.string()
        .nullable()
        .optional()
        .matches(/^\d{10}$/, 'Alternate Mobile Number must be 10 digits')
        .notOneOf([Yup.ref('phoneNumber'), null], 'Alternate Mobile Number must be different from Phone Number'),
    spouseName: Yup.string().when('maritalStatus', (maritalStatus, schema) => {
        return maritalStatus === 'Married'
            ? schema.required("Spouse’s Name is required").min(3, "Name must be at least 3 characters long")
            : schema.notRequired();
    }),
    occupation: Yup.string()
        .required('Occupation is required'),
    nationality: Yup.string()
        .required('Nationality is required'),
    // vehicleType: Yup.string()
    //     .required('Vehicle Type is required')
    //     .oneOf(VehicleTypeOptions, 'Invalid Vehicle Type'),
    image: Yup.string()
        .required('Photograph is required')
        .test(
            'is-base64',
            'Photograph must be a valid base64 string',
            (value) => {
                if (!value) return false;
                const base64Pattern = /^data:image\/(webp);base64,/;
                return base64Pattern.test(value);
            }
        ),
    sign: Yup.string()
        .nullable()
        .optional()
        .test(
            'is-base64',
            'Signature must be a valid base64 string',
            (value) => {
                if (!value) return true;
                const base64Pattern = /^data:image\/(webp);base64,/;
                return base64Pattern.test(value);
            }
        ),
});

const PersonalInformation = () => {
    const { goNext, form } = useWizardContext();

    const [posts, setPosts] = useState({})

    const occupations = [
        "Non-Working",
    ]

    const fetchPosts = useCallback(async () => {
        const response = await axios.get("/career-post?response=json");
        setPosts(response.data)
    }, [])

    useEffect(() => {
        fetchPosts()
    }, [fetchPosts])

    return (
        <Formik
            initialValues={{
                careerPostId: form?.careerPostId || '',
                fullName: form?.fullName || '',
                fatherOrHusbandName: form?.fatherOrHusbandName || '',
                currentAddress: form?.currentAddress || '',
                permanentAddress: form?.permanentAddress || '',
                dateOfBirth: form?.dateOfBirth || '',
                placeOfBirth: form?.placeOfBirth || '',
                maritalStatus: form?.maritalStatus || '',
                email: form?.email || '',
                phoneNumber: form?.phoneNumber || '',
                altMobileNo: form?.altMobileNo || '',
                occupation: form?.occupation || '',
                spouseName: form?.spouseName || '',
                spouseMobile: form?.spouseMobile || '',
                spouseOccupation: form?.spouseOccupation || '',
                nationality: form?.nationality || 'Indian',
                vehicleType: form?.vehicleType || '',
                image: form?.image || null,
                sign: form?.sign || null,
            }}
            validationSchema={validationSchema}
            onSubmit={(values) => {
                goNext(values)
            }}
        >
            {({ handleSubmit, values, setFieldValue }) => (
                <Form onSubmit={handleSubmit} as={BootstrapForm}>
                    <Row className="mb-3">
                        <Col md={8}>
                            <div className="mb-3">
                                <BootstrapForm.Label>Appling For?</BootstrapForm.Label>
                                <Field name="careerPostId" as={BootstrapForm.Select} className="form-control">
                                    <option value="">Select Post</option>
                                    {
                                        !!Object.keys(posts)?.length &&
                                        Object.keys(posts)?.map((postId) => (
                                            <option value={postId} key={postId}>{posts[postId]}</option>
                                        ))
                                    }
                                </Field>
                            </div>
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
                                        <BootstrapForm.Label>Father's Name</BootstrapForm.Label>
                                        <Field
                                            name="fatherOrHusbandName"
                                            as={BootstrapForm.Control}
                                            type="text"
                                            placeholder="Enter Father's name"
                                        />
                                        <ErrorMessage name="fatherOrHusbandName" component="div" className="text-danger" />
                                    </BootstrapForm.Group>
                                </Col>
                            </Row>

                            <Row>
                                <Col md={4} className="mb-3">
                                    <BootstrapForm.Group>
                                        <BootstrapForm.Label>Date of Birth</BootstrapForm.Label>
                                        <Field name="dateOfBirth" as={BootstrapForm.Control} type="date" max={moment(new Date()).subtract("18", "years").format("YYYY-MM-DD")} />
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
                            </Row>

                            <Row>
                                <Col md={6} className="mb-3">
                                    <BootstrapForm.Group>
                                        <BootstrapForm.Label>Mobile Number</BootstrapForm.Label>
                                        <Field
                                            name="phoneNumber"
                                            as={BootstrapForm.Control}
                                            type="text"
                                            placeholder="Enter your mobile number"
                                        />
                                        <ErrorMessage name="phoneNumber" component="div" className="text-danger" />
                                    </BootstrapForm.Group>
                                </Col>
                                <Col md={6} className="mb-3">
                                    <BootstrapForm.Group>
                                        <BootstrapForm.Label>Alternate Mobile Number</BootstrapForm.Label>
                                        <Field
                                            name="altMobileNo"
                                            as={BootstrapForm.Control}
                                            type="text"
                                            placeholder="Enter your alternate mobile number"
                                        />
                                        <ErrorMessage name="altMobileNo" component="div" className="text-danger" />
                                    </BootstrapForm.Group>
                                </Col>
                            </Row>
                            <div className="mb-3">
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
                            </div>
                            <div className="mb-3">
                                <BootstrapForm.Group>
                                    <BootstrapForm.Label>Permanent Address</BootstrapForm.Label>
                                    <Field
                                        name="permanentAddress"
                                        as="textarea"
                                        rows={3}
                                        placeholder="Enter your permanent address"
                                        className="form-control"
                                    />
                                    <ErrorMessage name="permanentAddress" component="div" className="text-danger" />
                                </BootstrapForm.Group>
                            </div>
                            <Row>
                                <Col md={4} className="mb-3">
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
                                <Col md={4} className="mb-3">
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
                                {values.maritalStatus === 'Married' && (
                                    <>
                                        <Col md={4} className="mb-3">
                                            <BootstrapForm.Group>
                                                <BootstrapForm.Label>Spouse's Name</BootstrapForm.Label>
                                                <Field
                                                    name="spouseName"
                                                    as={BootstrapForm.Control}
                                                    type="text"
                                                    placeholder="Enter Spouse’s Name"
                                                />
                                                <ErrorMessage name="spouseName" component="div" className="text-danger" />
                                            </BootstrapForm.Group>
                                        </Col>
                                        <Col md={4} className="mb-3">
                                            <BootstrapForm.Group>
                                                <BootstrapForm.Label>Spouse's Mobile Number</BootstrapForm.Label>
                                                <Field
                                                    name="spouseMobile"
                                                    as={BootstrapForm.Control}
                                                    type="text"
                                                    placeholder="Enter Spouse's Mobile No."
                                                />
                                                <ErrorMessage name="spouseMobile" component="div" className="text-danger" />
                                            </BootstrapForm.Group>
                                        </Col>
                                        <Col md={4} className="mb-3">
                                            <BootstrapForm.Group>
                                                <BootstrapForm.Label>Spouse's Occupation</BootstrapForm.Label>
                                                <Field
                                                    name="spouseOccupation"
                                                    as={BootstrapForm.Select}
                                                    type="text"
                                                    placeholder="Enter Spouse's Occupation"
                                                    className="form-control"
                                                >
                                                    <option value="">Working</option>
                                                    {
                                                        occupations.map((des) => (
                                                            <option value={des} key={des}>{des}</option>
                                                        ))
                                                    }
                                                </Field>
                                                <ErrorMessage name="spouseOccupation" component="div" className="text-danger" />
                                            </BootstrapForm.Group>
                                        </Col>
                                        {
                                            ((!occupations.includes(values?.spouseOccupation))) && (
                                                <Col md={6} className="mb-3">
                                                    <BootstrapForm.Group>
                                                        <BootstrapForm.Label>Spouse's Occupation</BootstrapForm.Label>
                                                        <Field
                                                            name="spouseOccupation"
                                                            as={BootstrapForm.Control}
                                                            type="text"
                                                            placeholder="Enter Spouse's Occupation"
                                                        />
                                                        <ErrorMessage name="spouseOccupation" component="div" className="text-danger" />
                                                    </BootstrapForm.Group>
                                                </Col>
                                            )
                                        }
                                    </>
                                )}


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
                                <ErrorMessage name="image" component="div" className="text-danger" />
                            </div>
                            <div className="mb-3">
                                <BootstrapForm.Label>Upload Signature</BootstrapForm.Label>
                                <ImagePicker done={(sign) => setFieldValue("sign", sign)} image={values.sign} width={500} height={200} />
                                <ErrorMessage name="sign" component="div" className="text-danger" />
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
