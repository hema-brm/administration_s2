// assets/app.js
import 'tailwindcss/base.css';
import 'tailwindcss/components.css';
import 'tailwindcss/utilities.css';
import React from 'react';
import ReactDOM from 'react-dom';

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import './js/index.js';
import './js/handleCheckbox.js';
//import '/js/handleModal.js;'


const PaymentsList = () => {
  return (
    <div>
      <h1 className="text-4xl font-bold text-center">Payments List</h1>
    </div>
  );
};


ReactDOM.render(<PaymentsList />, document.getElementById('paymentroot'));


