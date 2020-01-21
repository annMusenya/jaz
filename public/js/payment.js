paypal.Button.render({
    env: 'sandbox',
    payment: function(data, actions) {
      return actions.request.post('api/create-payment/')
        .then(function(res) {
          return res.id;
        });
    },
    onAuthorize: function(data, actions) {
      return actions.request.post('/api/execute-payment/', {
        paymentID: data.paymentID,
        payerID:   data.payerID
      })
        .then(function(res) {
          alert('Payment Went Through');
        });
    }
}, '#paypal-button');