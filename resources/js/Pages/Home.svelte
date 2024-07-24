<script>
    import { onMount } from "svelte";
    import Swal from "sweetalert2";

    let inputText = "";
    let outputText = "";
    let showCopyButton = false;

    const apiUrl = "http://127.0.0.1:8000/api";

    async function encryptText() {
        try {
            const response = await fetch(`${apiUrl}/encrypt`, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ text: inputText }),
            });
            const data = await response.json();
            if (response.ok) {
                outputText = data.text;
                showCopyButton = true;

                Swal.fire({
                    icon: "success",
                    title: "Éxito",
                    text: "Texto encriptado correctamente.",
                });
                inputText = "";

            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: data.error,
                });
            }
        } catch (error) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Error en la conexión con el servidor",
            });
        }
    }

    async function decryptText() {
        try {
            const response = await fetch(`${apiUrl}/decrypt`, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ text: inputText }),
            });
            const data = await response.json();
            if (response.ok) {
                outputText = data.text;
                showCopyButton = true;

                Swal.fire({
                    icon: "success",
                    title: "Éxito",
                    text: "Texto desencriptado correctamente.",
                });
                inputText = "";

            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: data.error,
                });
            }
        } catch (error) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Error en la conexión con el servidor",
            });
        }
    }

    function copyText() {
        navigator.clipboard.writeText(outputText).then(() => {
            Swal.fire({
                icon: "success",
                title: "Éxito",
                text: "Texto copiado al portapapeles",
            });
        });
    }
</script>

<div class="container mt-5">
    <h1 class="text-center mb-4">Encriptador de Texto</h1>
    <div class="form-group">
        <textarea
            bind:value={inputText}
            placeholder="Ingrese un texto aquí"
            class="form-control mb-3"
            rows="4"
        ></textarea>
    </div>
    <div class="d-flex justify-content-between mb-3">
        <button class="btn btn-primary" on:click={encryptText}>Encriptar</button
        >
        <button class="btn btn-secondary" on:click={decryptText}
            >Desencriptar</button
        >
    </div>
    <div class="textarea {outputText ? 'has-text' : ''}">
        <textarea bind:value={outputText} class="form-control" readonly rows="4"
        ></textarea>
    </div>
    {#if showCopyButton}
        <button class="btn btn-info mt-3" on:click={copyText}>Copiar</button>
    {/if}
</div>
