<template>
    <section class="h-100 gradient-form" style="background-color: #eee">
        <form @submit.prevent="conectar">
            <div class="container py-5 h-100">
                <div
                    class="row d-flex justify-content-center align-items-center h-100"
                >
                    <div class="col-xl-5">
                        <div class="card rounded-3 text-black">
                            <div class="row g-0">
                                <div class="col-lg-12">
                                    <div class="card-body p-md-5 mx-md-4">
                                        <div class="text-center">
                                            <img
                                                src="https://api.freelogodesign.org/assets/thumb/logo/5301_400.png"
                                                style="width: 185px"
                                                alt="logo"
                                            />
                                            <h2>Cadastro de Clientes</h2>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <div>
                                                <p>Username</p>
                                                <input
                                                    type="email"
                                                    v-model="formemail"
                                                    id="formemail"
                                                    class="form-control"
                                                    placeholder="email"
                                                />
                                            </div>
                                            <div>
                                                <p>Password</p>
                                                <input
                                                    type="password"
                                                    v-model="formpassword"
                                                    id="formpassword"
                                                    class="form-control"
                                                />
                                            </div>
                                        </div>

                                        <!-- <button type="submit">Enviar</button> -->
                                        <button
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded"
                                            type="submit"
                                        >
                                            Login
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</template>
<script>
import { useVuelidate } from "@vuelidate/core";
import { required, minLength, email } from "@vuelidate/validators";
import UsuarioDataService from "@/services/UsuarioDataService";
export default {
    name: "LoginView",
    setup() {
        return {
            v$: useVuelidate(),
        };
    },
    data() {
        return {
            formemail: "",
            formpassword: "",
        };
    },
    validations() {
        return {
            formemail: { required, email },
            formpassword: { minLength: minLength(3) },
        };
    },
    methods: {
        conectar: async function () {
            console.log("conectar" + this.formemail + "-" + this.formpassword);
            this.v$.$touch();
            if (!this.v$.$invalid) {
                await this.connecterUsuario();
            }
            console.log("conectarrr");
        },
        connecterUsuario: async function () {
            this.$emit("loading:start");
            try {
                const reponse = await UsuarioDataService.conectar({
                    email: this.formemail,
                    password: this.formpassword,
                });
                console.log("conectar2");
                console.log("conectar2");
                this.$store.commit("setSession", {
                    key: "usuario_id",
                    value: reponse.data.usuario.id,
                });
                console.log("conectar3");
                console.log(reponse);
                localStorage.setItem("jwt-token", reponse.data.token);
                console.log("token" + reponse.data.token);

                this.$router.push({ name: "home" });
            } catch (error) {
                console.error("Erro ao buscar os dadds:", error);

                if (
                    error.response &&
                    error.response.data &&
                    error.response.data.erreur
                ) {
                    this.erreurServeur = error.response.data.erreur;
                } else {
                    this.erreurServeur = "Ocorreu um erro inesperado.";
                }
            } finally {
                this.$emit("loading:end");
            }
        },
    },
};
</script>
