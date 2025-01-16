import React from "react";
import ReactDOM from 'react-dom/client';
import StepWizard from "./StepWizard";

// Mount the StepWizard component in a div with the id `stepWizardApp`
// ReactDOM.render(<StepWizard />, document.getElementById("stepWizardApp"));

const root = ReactDOM.createRoot(document.getElementById("stepWizardApp"));
root.render(<StepWizard />);
