import React, { createContext, useContext, useState } from 'react';
import PersonalInformation from './PersonalInformation';
import AcademicRecords from './AcademicRecords';
import Employment from './Employment';
import SalaryDetails from './SalaryDetails';
import AdditionalInformation from './AdditionalInformation';

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

    return (
        <WizardContext.Provider value={{ steps, currentStep, setCurrentStep }}>
            {children}
        </WizardContext.Provider>
    );
};
