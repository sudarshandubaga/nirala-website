import React from 'react'
import { Button } from 'react-bootstrap'
import { useWizardContext } from './WizardContext';

const WizardButtons = () => {
    const { steps, currentStep, setCurrentStep } = useWizardContext();


    const goBack = () => {
        if (currentStep > 0) setCurrentStep(currentStep - 1);
    };

    return (
        <div className='d-flex'>
            {
                currentStep > 0 &&
                <Button type='button' variant='secondary' onClick={goBack} >
                    &laquo; Previous
                </Button>
            }
            <button type="submit" className='ml-auto site-button'>
                {currentStep < steps.length - 1 ? "Next" : "Submit"} &raquo;
            </button>
        </div>
    )
}

export default WizardButtons