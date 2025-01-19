import React from 'react';
import { useWizardContext, WizardProvider } from './components/WizardContext';
import { Button } from 'react-bootstrap';

const StepWizardContent = () => {
    const { steps, currentStep, setCurrentStep, form } = useWizardContext();


    const getVariant = (index) => {
        let variant = index < currentStep ? 'success' : 'light'
        if (currentStep === index) variant = 'primary'
        return variant
    }

    return (
        <div>
            <div className='mb-5 d-flex'>
                {
                    steps.map((step, index) => (
                        <Button variant={getVariant(index)} type='button' onClick={() => setCurrentStep(index)} className='d-flex flex-column text-center align-items-center' style={{
                            flex: 1
                        }} key={index}>
                            <span className='px-2 bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center' style={{
                                aspectRatio: 1
                            }}>{index + 1}</span>
                            <span>{step.title}</span>
                        </Button>
                    ))
                }
            </div>
            <h3 className="mb-4">{steps[currentStep].title}</h3>
            {/* {JSON.stringify(form)} */}
            {steps[currentStep].component}
        </div>
    );
};

const StepWizard = () => {
    return (
        <WizardProvider>
            <StepWizardContent />
        </WizardProvider>
    );
};

export default StepWizard;
