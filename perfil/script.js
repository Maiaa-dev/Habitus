// script.js
document.addEventListener('DOMContentLoaded', () => {
  const radios = document.querySelectorAll('input[name="info"]');
  let opcaoescolhida = null;

  // Se por acaso houver mais de um 'checked' no HTML, mantém só o primeiro marcado
  const checkedRadios = Array.from(radios).filter(r => r.checked);
  if (checkedRadios.length > 1) {
    checkedRadios.slice(1).forEach(r => r.checked = false);
  }

  // Sincroniza a classe 'active' dos labels com o estado dos radios
  function syncActive() {
    radios.forEach(radio => {
      const label = document.querySelector('label[for="' + radio.id + '"]');
      if (!label) return;
      label.classList.toggle('active', radio.checked);
    });
  }

  // Esconde todas as .inativa e (opcional) reseta inputs dentro delas
  function hideAllInativas(reset = true) {
    document.querySelectorAll('.inativa').forEach(div => {
      div.style.display = 'none';
      if (reset) {
        div.querySelectorAll('input').forEach(input => {
          if (input.type === 'radio' || input.type === 'checkbox') input.checked = false;
          else input.value = '';
        });
      }
    });
  }

  // Mostra a div referente ao valor escolhido (id="div-<valor>")
  function showDivFor(value) {
    const div = document.getElementById('div-' + value);
    if (div) div.style.display = 'block';
  }

  syncActive();

  // Se já houver um radio marcado no carregamento, mostra a respectiva div
  const initiallyChecked = document.querySelector('input[name="info"]:checked');
  if (initiallyChecked) {
    opcaoescolhida = initiallyChecked.value;
    showDivFor(opcaoescolhida);
  }

  // Eventos
  radios.forEach(radio => {
    radio.addEventListener('change', function () {
      hideAllInativas(true);         // limpa e reseta as divs
      opcaoescolhida = this.value;   // guarda a opção
      showDivFor(opcaoescolhida);    // mostra a correspondente
      syncActive();                  // atualiza visual dos labels
    });

    // garante sincronização visual caso o clique no label não dispare 'change' imediatamente
    const label = document.querySelector('label[for="' + radio.id + '"]');
    if (label) {
      label.addEventListener('click', () => {
        // curto delay para permitir que o browser atualize checked e depois sincronizamos
        setTimeout(syncActive, 0);
      });
    }
  });
});
