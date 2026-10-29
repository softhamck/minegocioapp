{{-- Asistente de IA: genera descripción o texto para redes a partir del nombre y la descripción del producto --}}
<div id="ai-assistant" class="mt-3 rounded-xl border border-[#E9D5FF] bg-[#FAF5FF]/80 p-4">
    <div class="flex flex-wrap items-center gap-2">
        <span class="text-sm font-semibold text-[#7C3AED]">✨ Asistente de IA</span>
        <button type="button" data-ai-type="descripcion"
                class="ai-btn rounded-lg bg-gradient-to-r from-[#7C3AED] to-[#EC4899] px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:opacity-90 disabled:opacity-50">
            Mejorar descripción
        </button>
        <button type="button" data-ai-type="publicacion"
                class="ai-btn rounded-lg border border-[#C4B5FD] bg-white px-3 py-1.5 text-xs font-semibold text-[#7C3AED] shadow-sm transition hover:bg-[#F3E8FF] disabled:opacity-50">
            Crear texto para WhatsApp / Instagram
        </button>
        <span id="ai-status" class="text-xs text-[#6B7280]"></span>
    </div>
    <p class="mt-2 text-xs text-[#6B7280]">
        Escribe el nombre y algunos detalles del producto. La IA te propone un texto que puedes editar.
        No escribas datos personales (nombres, teléfonos o direcciones).
    </p>
    <p class="mt-2 rounded-lg border border-amber-200 bg-amber-50 px-3 py-2 text-xs text-amber-800">
        ⚠️ <strong>Revisa siempre el texto antes de guardarlo o publicarlo.</strong>
        Lo genera una inteligencia artificial de forma automática y puede contener errores o información que no corresponde a tu producto.
        Úsala solo para describir productos reales; el uso indebido puede bloquear el asistente.
    </p>

    <div id="ai-social" class="mt-3 hidden">
        <label class="mb-1 block text-xs font-semibold text-[#374151]">Texto para redes</label>
        <textarea id="ai-social-text" rows="4" readonly
                  class="w-full resize-none rounded-lg border border-[#F3E8FF] bg-white p-3 text-sm text-[#1F2937]"></textarea>
        <button type="button" id="ai-copy"
                class="mt-2 rounded-lg border border-[#C4B5FD] bg-white px-3 py-1.5 text-xs font-semibold text-[#7C3AED] hover:bg-[#F3E8FF]">
            Copiar texto
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const box = document.getElementById('ai-assistant');
        if (!box) return;

        const nameInput = document.getElementById('name');
        const description = document.getElementById('description');
        const priceInput = document.getElementById('price');
        const status = document.getElementById('ai-status');
        const socialBox = document.getElementById('ai-social');
        const socialText = document.getElementById('ai-social-text');
        const buttons = box.querySelectorAll('.ai-btn');
        const token = document.querySelector('meta[name="csrf-token"]')?.content;

        buttons.forEach(function (btn) {
            btn.addEventListener('click', async function () {
                const type = btn.dataset.aiType;

                if (!nameInput || !nameInput.value.trim()) {
                    status.textContent = 'Primero escribe el nombre del producto.';
                    nameInput?.focus();
                    return;
                }

                buttons.forEach(b => b.disabled = true);
                status.textContent = 'Generando… (puede tardar unos segundos)';

                try {
                    const res = await fetch(@json(route('emprendedor.ai.product-text')), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token,
                        },
                        body: JSON.stringify({
                            type: type,
                            name: nameInput.value.trim(),
                            details: description ? description.value.trim() : '',
                            price: priceInput ? priceInput.value.trim() : '',
                        }),
                    });
                    const data = await res.json();

                    if (!res.ok) {
                        status.textContent = data.message || 'No se pudo generar el texto.';
                        return;
                    }

                    if (type === 'descripcion' && description) {
                        description.value = data.text.slice(0, 1000);
                        description.dispatchEvent(new Event('input'));
                        status.textContent = 'Listo. Revisa y ajusta la descripción antes de guardar.';
                    } else {
                        socialText.value = data.text;
                        socialBox.classList.remove('hidden');
                        status.textContent = 'Listo. Revisa el texto antes de copiarlo y compartirlo.';
                    }
                } catch (e) {
                    status.textContent = 'Error de conexión. Intenta de nuevo.';
                } finally {
                    buttons.forEach(b => b.disabled = false);
                }
            });
        });

        document.getElementById('ai-copy')?.addEventListener('click', async function () {
            try {
                await navigator.clipboard.writeText(socialText.value);
                status.textContent = 'Texto copiado.';
            } catch (e) {
                socialText.removeAttribute('readonly');
                socialText.select();
                status.textContent = 'Selecciona el texto y cópialo.';
            }
        });
    });
</script>
