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

    function resetForm() {
        inputText = "";
        outputText = "";
        showCopyButton = false;
    }
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');

    * {
        font-family: "Inter", sans-serif;
    }
</style>

<main class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-4-text-center">
            <img src="./assets/img/Vector.png" alt="Logo app" class="img-fluid mb-3">
            <h1 class="text-center mb-4">
                <i class="fa-solid fa-key"></i>
                Encriptador de Texto
            </h1>
            <textarea
                bind:value={inputText}
                placeholder="Ingrese un texto aquí"
                class="form-control mb-3 p-4 text-center"
                rows="4"
            ></textarea>
            <div class="alert alert-info" role="alert">
                <i class="fas fa-exclamation-circle"></i> Solo letras minúsculas y sin acentos.
            </div>
            <div class="d-flex gap-2 justify-content-center align-items-center">
                <div class="p-2">
                    <button class="btn btn-outline-success btn-lg px-4" on:click={encryptText}>
                        <i class="fas fa-user-secret"></i> Encriptar
                    </button>
                </div>
                <div class="p-2">
                    <button class="btn btn-outline-primary btn-lg" on:click={decryptText}>
                        <i class="fas fa-gear"></i> Desencriptar
                    </button>
                </div>
            </div>
            <textarea
                bind:value={outputText}
                class="form-control text-center m-3 p-4"
                readonly
                rows="4"
                placeholder="Ningún mensaje fue encontrado"
            ></textarea>
            {#if showCopyButton}
            <div class="d-flex gap-2 mb-3 justify-content-center align-items-center">
                <button class="btn btn-outline-primary btn-lg mt-3 " on:click={copyText}>
                    <i class="far fa-copy"></i> Copiar
                </button>
                <button class="btn btn-outline-danger btn-lg mt-3" on:click={resetForm}>
                    <i class="fa-solid fa-rotate-right"></i>
                    Reset
                </button>
            </div>
            {/if}
        </div>
    </div>
</main>
