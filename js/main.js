$(document).ready(function(){

  let login = $('#input_login');
  let pass = $('#input_pass');
  let email = $('#input_email');
  let tel = $('#input_tel');
  let birth = $('#input_birth');

  let form = $('form');
  let input = $('.hidden-inputs');
  let sign = $('#sign');
  let send = $('#send');
  input.hide();
  sign.attr('disabled', '')
  let userFields = ['login','password', 'email', 'phone', 'BirthDay'];

  // form.on('submit',function (e) {
  //   e.preventDefault();
  //   if ((login.val() === '' || pass.val() === '') || (tel.val() === '' || email.val() === '' || birth.val() === '')){
  //     alert("Заполните поля");
  //     sign.attr('type', null)
  //     return;
  //   };
  //   this.submit();
  // })

  $('.shadow').on('click', function (e) {
    input.show();
    setInterval(() => {
      send.attr('disabled', '');
    }, 1000)
    if (tel.val() === '' || email.val() === '' || birth.val() === '' || login.val() === '' || pass.val() === ''){
      alert("Заполните поля");
      sign.attr('type', null);
      return;
    } else {
      $('.shadow').hide();
      sign.attr('disabled', null);
    }
  });

  send.on('click', function (e) {
    if (login.val() === '' || pass.val() === ''){
      alert("Заполните поля");
      e.preventDefault();
    }else {
      send.attr('disabled', null)
    }
  })

  let regex = /[а-яА-Я,\.;\'\/<>\}\{\[\]\)\(\*&%\^%\$#@!\|":\?=\+_\s]/g

  document.querySelector('#input_login').oninput = function(){
    this.value = this.value.replace(regex, '');
    $('#input_login').each(function () {
      if ($(this).text().length > 10){
          $(this).text($(this).text().substring(0,10)+ '...');
      }
  })
  };
  document.querySelector('#input_pass').oninput = function(){
    this.value = this.value.replace(regex, '');
  };
});