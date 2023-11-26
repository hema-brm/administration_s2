// assets/app.js
import 'tailwindcss/base.css';
import 'tailwindcss/components.css';
import 'tailwindcss/utilities.css';
import React from 'react';
import ReactDOM from 'react-dom';

const PaymentsList = () => {
  return (
    <div>
      <h1 className="text-4xl font-bold text-center">Payments List</h1>
    </div>
  );
};


ReactDOM.render(<PaymentsList />, document.getElementById('paymentroot'));

