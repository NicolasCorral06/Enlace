<?php

if (!isset($_COOKIE['cookieEnlace'])) {
    $mostrar_avisos = true; // Mostrar o aviso
} else {
    $mostrar_avisos = false; // Não mostrar o aviso
}
?>

<?php if ($mostrar_avisos): ?>
<!-- Modal principal -->
<div class="modal fade" id="cookieModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Este site usa cookies!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="textomodal">
            Utilizamos de cookies para auxiliar sua navegação, melhorando sua experiência.<br>
            Ao navegar no nosso site, você concorda com o <a href="#" data-toggle="modal" data-target="#termoCookie">uso de cookies</a>.
        </p>
      </div>
      <div class="modal-footer">
        <button id="aceitar-cookies" class="btn btn-success" onclick="aceitarCookies()">Aceitar</button>
        <button id="negar-cookies" class="btn btn-danger" onclick="negarCookies()">Negar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para Termos de Uso -->
<div class="modal fade" id="termoCookie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Termos de uso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="textomodal">
        Este site usa cookies para melhorar sua experiência, personalizar conteúdos e analisar o tráfego. Ao navegar, você concorda com seu uso. <br><br>
        Os cookies ajudam no funcionamento do site, lembram preferências e coletam dados para melhorias. Você pode desativá-los nas configurações do navegador, mas isso pode limitar algumas funções.<br><br>
        Última atualização: <b>11/11/2024</b>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<?php endif; ?>

<script>
// Função para aceitar cookies
function aceitarCookies() {
    document.cookie = "cookieEnlace=true; max-age=" + 30*24*60*60 + "; path=/";
    $('#cookieModal').modal('hide');
}

// Função para negar cookies
function negarCookies() {
    document.cookie = "cookieEnlace=false; max-age=" + 10*14*30*30 + "; path=/";
    $('#cookieModal').modal('hide');
}

// Exibir o modal quando a página for carregada (caso nenhum cookie exista)
document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById("cookieModal");
    if (modal && !getCookie('cookieEnlace')) {
        $('#cookieModal').modal('show');
    }
});

// Função para verificar o cookie
function getCookie(name) {
    let value = "; " + document.cookie;
    let parts = value.split("; " + name + "=");
    if (parts.length === 2) return parts.pop().split(";").shift();
}
</script>
