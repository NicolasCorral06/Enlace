document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('telefone').addEventListener('input', function() {
        formatar('(00) 00000-0000', this);
    });
});

// Função para formatar o telefone (ex: (XX) XXXXX-XXXX)
function formatar(mascara, documento) {
    let i = documento.value.length;
    let saida = mascara.substring(i, i + 1);

    // Se o próximo caractere não for igual ao esperado, adiciona o caractere da máscara
    if (saida != undefined && documento.value[i] != saida) {
        documento.value += saida;
    }
}

// Função de validação de telefone
function validarTel() {
    let value = document.getElementById("telefone").value;
    let re = /^\(\d{2}\) \d{5}-\d{4}$/;  // Regular expression para o formato (XX) XXXXX-XXXX
    if (!re.test(value)) {
        // Campo inválido, retorna false para o formulário não ser submetido
        alert('Telefone Inválido');
        return false;
    }
    return true;
}

function mascara_cpf(){
    var cpf = document.getElementById('cpf');
    if(cpf.value.length == 3 || cpf.value.length == 7){
    cpf.value += ".";
    }else if(cpf.value.length == 11){
    cpf.value += "-";
    }
}



function validarCPF() {
    let value = document.getElementById("cpf").value;
    let re =
    /([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})/g;

    if (!re.test(value)) {
    // campo inválido, retorna false para o formulário não ser submetido
    alert('CPF Inválido');
    document.form.cpf.focus();
    return false;
    }
    return true;
}


function validarTudo() {
    // se um deles for inválido, retorna false e o form não é submetido
    return validarNome() && validarTel() && validarDtNasc() &&
    validarCPF();
}


const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});




// mostrar ou ocultar a sidebar
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})







const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})





if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})


// botão pra imprimir a tela
function printReport(event) {
	event.preventDefault(); 
	window.print();

}

