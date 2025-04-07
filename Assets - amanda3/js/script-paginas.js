// IMPORTANTES - GERAIS
function scrollLeft() {
  const container = document.querySelector('.container');
  const scrollAmount = container.offsetWidth; 
  container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
}

function scrollRight() {
  const container = document.querySelector('.container');
  const scrollAmount = container.offsetWidth; 
  container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
}



// ------------ TEMA ESCURO E CLARO -------------

// Função para alternar o tema
function changeTheme() {
    const currentTheme = rootHtml.getAttribute("data-theme"); 
    const newTheme = currentTheme === "dark" ? "light" : "dark"; 
    rootHtml.setAttribute("data-theme", newTheme);

    localStorage.setItem("theme", newTheme);

    if (toggleTheme) {
        toggleTheme.classList.toggle("bi-sun"); 
        toggleTheme.classList.toggle("bi-moon-stars");
    }
}

if (toggleTheme) {
    toggleTheme.addEventListener("click", changeTheme);
}

// ------------ TAMANHO DA FONTE -------------
const maxDeslocamento = 4; // Máximo de 4 níveis de ajuste para cima ou para baixo
let deslocamentoAtual = 0; // Controla a diferença do tamanho inicial da fonte

function alterarFonte(incremento) {
  const elementos = document.querySelectorAll('.text-content');
  elementos.forEach(el => {
    const currentSize = parseFloat(window.getComputedStyle(el).getPropertyValue('font-size'));
    const newSize = currentSize + incremento;
    el.style.fontSize = newSize + 'px';
  });
}

function aumentarFonte() {
  if (deslocamentoAtual < maxDeslocamento) {
    deslocamentoAtual++;
    alterarFonte(2);
  } else {
  }
}

function diminuirFonte() {
  if (deslocamentoAtual > -maxDeslocamento) {
    deslocamentoAtual--;
    alterarFonte(-2);
  } else {
  }
}



// ----------- EQUIPE - DROPDOWN ------------
 const dropdownMenu = document.querySelector('.dropdown-menu');
 const selects = dropdownMenu.querySelectorAll('select');

 selects.forEach(select => {
     select.addEventListener('click', function(event) {
         event.stopPropagation(); 
     });
 });





// ----------- PAGINA LOGIN ----------------
document.getElementById('loginForm').addEventListener('submit', function(event) {
  event.preventDefault(); // Impede o envio do formulário para realizar a verificação
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;

  if (email === '' || password === '') {
      alert('Por favor, preencha todos os campos.');
      return;
  }
  const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
  if (!email.match(emailPattern)) {
      alert('Por favor, insira um endereço de e-mail válido.');
      return;
  }

  alert('Login bem-sucedido!');
  this.submit(); // Envia o formulário
});







// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
      // ----------- NAVBAR PERFIL ----------------
      (function() {
        "use strict";

        /**
         * Helper function to select elements
         */
        const select = (el) => document.querySelector(el);

        /**
         * Mobile nav toggle
         */
        const toggleMenu = () => {
            document.body.classList.toggle('mobile-nav-active');
            const toggleIcon = select('.mobile-nav-toggle');
            toggleIcon.classList.toggle('bi-list');
            toggleIcon.classList.toggle('bi-x');
        };

        // Event listener for the mobile nav toggle
        const navToggle = select('.mobile-nav-toggle');
        if (navToggle) {
            navToggle.addEventListener('click', toggleMenu);
        }
      })();


      //-------------------------------------------------------------------------



      // GERAL - PRINCIPAL
      // Trocar as divs/menu
      function abrirMain(mainId) {
        const mains = document.querySelectorAll('section');
        mains.forEach(main => main.style.display = 'none');

          document.getElementById(mainId).style.display = 'block';
      }
  
      document.addEventListener('DOMContentLoaded', function() {
          abrirMain('mainUm');
      });

      

      //-------------------------------------------------------------------------



      // DADOS PESSOAIS
      // Verificações JS pro forms
      // ------ nome ------
      document.getElementById('nome').addEventListener('input', function (e) {
          const nomeError = document.getElementById('nome-error');
          let nome = e.target.value;

          // Converte a primeira letra de cada palavra para maiúscula
          nome = nome.toLowerCase().replace(/(?:^|\s)\S/g, function (letra) {
              return letra.toUpperCase();
          });

          e.target.value = nome;
          const nomePattern = /^[A-Za-zÀ-ÖØ-öø-ÿ\s]{2,}$/;

          // Verifica se o nome está no formato correto
          if (!nomePattern.test(nome.trim())) {
              nomeError.style.display = 'block';
              nomeError.textContent = "Por favor, insira um nome válido (somente letras, mínimo 2 caracteres).";
              e.target.classList.add('is-invalid'); 
          } else {
              nomeError.style.display = 'none';
              e.target.classList.remove('is-invalid');
          }
      });



      // ------ email ------
      document.getElementById('email').addEventListener('input', function (e) {
          const emailError = document.getElementById('email-error');
          const email = e.target.value;

          // Formato básico de e-mail
          const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
          if (!emailPattern.test(email)) {
              emailError.style.display = 'block';
              emailError.textContent = "Por favor, insira um e-mail válido.";
              e.target.classList.add('is-invalid');
          } else {
              emailError.style.display = 'none';
              e.target.classList.remove('is-invalid');
          }
      });


      // ------ telefone ------
      document.getElementById('telefone').addEventListener('input', function (e) {
          const telefoneError = document.getElementById('telefone-error');
          let telefone = e.target.value;

          // Remove qualquer caractere que não seja número
          telefone = telefone.replace(/\D/g, '');

          // Máscara (00)00000-0000
          telefone = telefone.replace(/^(\d{2})(\d)/, '($1)$2');
          telefone = telefone.replace(/(\d{5})(\d)/, '$1-$2');
          
          e.target.value = telefone;

          // Verifica se o número tem todos os dígitos iguais (ex: 11111111111 ou 55555555555)
          const allSameDigits = /^(\d)\1{10}$/.test(telefone.replace(/\D/g, ''));
          if (allSameDigits) {
              telefoneError.style.display = 'block';
              telefoneError.textContent = "O número de telefone não pode ter todos os dígitos iguais.";
              e.target.classList.add('is-invalid');
          } else {
              telefoneError.style.display = 'none';
              e.target.classList.remove('is-invalid');
          }

          // Verifica se o número está completo com o formato desejado
          if (!/^\(\d{2}\)\d{5}-\d{4}$/.test(telefone)) {
          }
      });


      // ------ data de nascimento ------
      document.getElementById('data-nascimento').addEventListener('input', function (e) {
          const dataError = document.getElementById('data-error');
          const dataNascimento = new Date(e.target.value);
          const hoje = new Date();

          // Limites de idade
          const idadeMinima = 18;
          const anoMinimo = 1925;

          // Calcula idade a partir da data inserida
          let idade = hoje.getFullYear() - dataNascimento.getFullYear();
          const mesDiferenca = hoje.getMonth() - dataNascimento.getMonth();
          if (mesDiferenca < 0 || (mesDiferenca === 0 && hoje.getDate() < dataNascimento.getDate())) {
              idade--;
          }

          // Verifica se a data é válida, se o usuário tem idade mínima e se o ano é maior que 1925
          if (
              isNaN(dataNascimento.getTime()) || 
              idade < idadeMinima ||             
              dataNascimento.getFullYear() < anoMinimo
          ) {
              dataError.style.display = 'block';
              dataError.textContent = "Não é permitido o cadastro de menores de 18 anos!";
              e.target.classList.add('is-invalid');
          } else {
              dataError.style.display = 'none';
              e.target.classList.remove('is-invalid');
          }
      });




      //-------------------------------------------------------------------------



      // AUTENTICAÇÃO
      // Função para validar se as senhas são iguais
      document.getElementById('formSenha').addEventListener('submit', function(event) {
          var password = document.getElementById('password').value;
          var confirmaSenha = document.getElementById('confirmaSenha').value;
          var errorMessage = document.getElementById('error-message');
          var passwordInput = document.getElementById('password');
          var confirmaSenhaInput = document.getElementById('confirmaSenha');
      
          if (password !== confirmaSenha) {
              event.preventDefault();
              errorMessage.style.display = 'block'; 
              passwordInput.classList.add('is-invalid');
              confirmaSenhaInput.classList.add('is-invalid');
          } else {
              errorMessage.style.display = 'none';
              passwordInput.classList.remove('is-invalid');
              confirmaSenhaInput.classList.remove('is-invalid');
          }
      });



      // Ir verificando requisitos obrigatórios da senha
      const passwordInput = document.getElementById('password');
      const lengthRequirement = document.getElementById('length');
      const uppercaseRequirement = document.getElementById('uppercase');
      const lowercaseRequirement = document.getElementById('lowercase');
      const numberRequirement = document.getElementById('number');
  
      // Função para atualizar ícone conforme requisito
      function updateIcon(element, condition) {
          const icon = element.querySelector('i');
          if (condition) {
              icon.classList.remove('bi-x');
              icon.classList.add('bi-check');
              element.classList.add('valid');
          } else {
              icon.classList.remove('bi-check');
              icon.classList.add('bi-x');
              element.classList.remove('valid');
          }
      }
  
      passwordInput.addEventListener('input', function() {
          const password = passwordInput.value;
          updateIcon(lengthRequirement, password.length >= 8);
          updateIcon(uppercaseRequirement, /[A-Z]/.test(password));
          updateIcon(lowercaseRequirement, /[a-z]/.test(password));
          updateIcon(numberRequirement, /\d/.test(password));
      });

      function validarSenha() {
          var novaSenha = document.getElementById('novaSenha').value;
          var confirmarSenha = document.getElementById('confirmarSenha').value;
          var erroSenha = document.getElementById('erroSenha');

          if (novaSenha !== confirmarSenha) {
              erroSenha.style.display = 'block';
          } else {
              erroSenha.style.display = 'none';
              alert("Senha alterada com sucesso!");
          }
      }


      
      //-------------------------------------------------------------------------


      // AGENDAMENTO
      // muda a seta
      const toggleButton = document.getElementById('toggleButton');
      const arrowIcon = document.getElementById('arrowIcon');

      toggleButton.addEventListener('click', () => {
          if (arrowIcon.classList.contains('bi-arrow-down')) {
              arrowIcon.classList.remove('bi-arrow-down');
              arrowIcon.classList.add('bi-arrow-up');
          } else {
              arrowIcon.classList.remove('bi-arrow-up');
              arrowIcon.classList.add('bi-arrow-down');
          }
      });


      // muda divs
      function abrirDiv1(secao) {
        if (secao === 'analise') {
          document.getElementById("analise").style.display = "block";
          document.getElementById("finalizados").style.display = "none";
        } else if (secao === 'finalizados') {
          document.getElementById("analise").style.display = "none";
          document.getElementById("finalizados").style.display = "block";
        }
      }



      //-------------------------------------------------------------------------



      // EXTRAS 
      (function() {
      "use strict";
      const select = (el) => document.querySelector(el);
      const toggleMenu = () => {
          document.body.classList.toggle('mobile-nav-active');
          const toggleIcon = select('.mobile-nav-toggle');
          toggleIcon.classList.toggle('bi-list');
          toggleIcon.classList.toggle('bi-x');
      };
      const navToggle = select('.mobile-nav-toggle');
      if (navToggle) {
          navToggle.addEventListener('click', toggleMenu);
      }
      })();



// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
// ------------------------------- FIM PERFIL CLIENTE -----------------------------------
// ------------------------------- FIM PERFIL CLIENTE -----------------------------------













