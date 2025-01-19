import React, { createContext, useContext, useState } from 'react';
import PersonalInformation from './PersonalInformation';
import AcademicRecords from './AcademicRecords';
import Employment from './Employment';
import SalaryDetails from './SalaryDetails';
import AdditionalInformation from './AdditionalInformation';
import moment from 'moment';

const WizardContext = createContext();

export const useWizardContext = () => useContext(WizardContext);

export const WizardProvider = ({ children }) => {
    const steps = [
        { title: "Personal Information", component: <PersonalInformation /> },
        { title: "Academic Records", component: <AcademicRecords /> },
        { title: "Employment Information", component: <Employment /> },
        { title: "Salary Details", component: <SalaryDetails /> },
        { title: "Additional Information", component: <AdditionalInformation /> },
    ];

    const [currentStep, setCurrentStep] = useState(0);

    const [form, setForm] = useState({
        fullName: 'John Doe',
        fatherOrHusbandName: 'Michael Doe',
        currentAddress: '123 Main Street, City, Country',
        dateOfBirth: moment(new Date()).subtract("18", "years").format("YYYY-MM-DD"),
        placeOfBirth: 'City, Country',
        maritalStatus: 'Bachelor',
        email: 'john.doe@example.com',
        phoneNumber: '1234567890',
        spouseName: '',
        occupation: 'Software Engineer',
        nationality: 'Indian',
        vehicleType: '4 Wheeler',
        image: null,
        sign: null,
        records: [
            {
                qualification: "B.Tech in Computer Science",
                yearPassed: "2012",
                institution: "ABC University",
                mainSubjects: "Computer Science, Programming, Data Structures",
                percentage: "80%",
                achievements: "Top 10 in class",
            },
            {
                qualification: "M.Tech in Software Engineering",
                yearPassed: "2014",
                institution: "XYZ University",
                mainSubjects: "Software Development, AI, Cloud Computing",
                percentage: "85%",
                achievements: "Research paper published",
            },
            {
                qualification: "PhD in Artificial Intelligence",
                yearPassed: "2020",
                institution: "LMN University",
                mainSubjects: "Deep Learning, Neural Networks",
                percentage: "90%",
                achievements: "Published 3 papers",
            },
        ],
        relatedToDirectors: "no",
        name: "John Doe",
        designation: "Software Engineer",
        convicted: "no",
        interviewed: "yes",
        expectedCtc: 1200000,
        noticePeriod: "30 days",
        references: [
            { serialNo: 1, name: "Jane Smith", company: "TechCorp", designation: "Manager", capacity: "Supervisor", contact: "+9876543210" },
            { serialNo: 2, name: "Alice Brown", company: "DevSolutions", designation: "Lead Developer", capacity: "Colleague", contact: "+1230984567" },
        ],
        professionalMembership: [
            { organization: 'IEEE', dateSince: '2015-03-01', contribution: 'Research and Development in AI' },
        ],
        employmentHistory: [
            {
                from: '2014-06-01',
                to: '2017-08-15',
                employer: 'TechCorp',
                designationOnJoining: 'Junior Software Engineer',
                designationOnLeaving: 'Software Engineer',
                jobDescription: 'Developed web applications, worked with a small team, and contributed to design and architecture.',
                salaryOnJoining: 30000,
                salaryOnLeaving: 50000,
                reasonOfLeaving: 'Pursued a new opportunity with a more challenging role.',
            },
            {
                from: '2017-09-01',
                to: '2022-12-31',
                employer: 'DevSolutions',
                designationOnJoining: 'Software Engineer',
                designationOnLeaving: 'Senior Software Engineer',
                jobDescription: 'Worked on backend systems, designed APIs, and implemented AI algorithms for company projects.',
                salaryOnJoining: 55000,
                salaryOnLeaving: 85000,
                reasonOfLeaving: 'Looking for career advancement and professional growth opportunities.',
            },
            {
                from: '2023-01-01',
                to: 'Present',
                employer: 'InnovativeTech',
                designationOnJoining: 'Senior Software Engineer',
                designationOnLeaving: 'Lead Software Engineer',
                jobDescription: 'Leading the development of large-scale software applications, mentoring junior developers, and overseeing project deadlines.',
                salaryOnJoining: 90000,
                salaryOnLeaving: 120000,
                reasonOfLeaving: 'Currently employed.',
            },
        ],
        particulars: [
            {
                title: "Remuneration",
                items: [
                    { name: 'Basic Salary', amount: 50000, remarks: 'Fixed monthly salary' },
                    { name: 'DA', amount: 5000, remarks: 'Dearness Allowance' },
                    { name: 'Other Allowance', amount: 2000, remarks: 'Transport Allowance' },
                ]
            },
            {
                title: "Residence",
                items: [
                    { name: 'Free accommodation', amount: 10000, remarks: 'Provided by the company' },
                    { name: 'Free furnished/semi furnished', amount: 5000, remarks: 'Accommodation allowance' },
                    { name: 'HRA', amount: 12000, remarks: 'House Rent Allowance' },
                    { name: 'Telephone Subsidy', amount: 1000, remarks: 'Communication allowance' },
                ]
            },
            {
                title: "Conveyance",
                items: [
                    { name: 'Company Car', amount: 15000, remarks: 'Company-provided car' },
                    { name: 'Conveyance Allowance', amount: 3000, remarks: 'Travel allowance' },
                    { name: 'Conveyance Reimbursement', amount: 2000, remarks: 'Reimbursement for fuel' },
                ]
            },
            {
                title: "Others",
                items: [
                    { name: 'Medical Subsidy/Allowance', amount: 5000, remarks: 'Health insurance allowance' },
                    { name: 'Leave Travel Allowance', amount: 8000, remarks: 'Travel allowance during holidays' },
                    { name: 'Bonus/Ex Gratia', amount: 20000, remarks: 'Annual bonus' },
                ]
            },
            {
                title: "Retirement benefits",
                items: [
                    { name: 'Contributory P.F.', amount: 4000, remarks: 'Employee Provident Fund contribution' },
                    { name: 'Gratuity', amount: 10000, remarks: 'Gratuity fund' },
                    { name: 'Superannuation', amount: 2500, remarks: 'Superannuation fund contribution' },
                ]
            }
        ],
        resumeFile: null
    });


    const goNext = (values) => {
        if (currentStep < steps.length - 1) setCurrentStep(currentStep + 1);
        setForm(form => ({ ...form, ...values }))
    }

    const goBack = () => {
        if (currentStep > 0) setCurrentStep(currentStep - 1);
    };

    return (
        <WizardContext.Provider value={{ steps, currentStep, setCurrentStep, form, goBack, goNext }}>
            {children}
        </WizardContext.Provider>
    );
};
