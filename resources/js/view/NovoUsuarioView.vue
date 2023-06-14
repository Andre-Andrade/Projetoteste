<template>
    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div
                class="row d-flex justify-content-center align-items-center h-100"
            >
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h2>Novo Usuario</h2>
                        </div>
                        <p
                            v-if="errorserver"
                            class="block text-md text-red-500"
                        >
                            {{ errorserver }}
                        </p>

                        <form @submit.prevent="actionnovousuario">
                            <!--<p class="text-center">Please login to your account</p>-->
                            {{}}
                            <div class="card-body p-md-5 mx-md-4">
                                <div>
                                    <p>Nome</p>
                                    <input
                                        type="text"
                                        v-model="formnome"
                                        id="formnome"
                                        class="form-control"
                                        placeholder=""
                                    />
                                    <p></p>
                                </div>
                                <div>
                                    <p>Email</p>
                                    <input
                                        type="email"
                                        v-model="formemail"
                                        id="formremail"
                                        class="form-control"
                                        placeholder=""
                                    />
                                    <p></p>
                                </div>
                                <div>
                                    <p>Password</p>
                                    <input
                                        type="password"
                                        v-model="formpassword"
                                        id="formpassword"
                                        class="form-control"
                                        placeholder=""
                                    />
                                    <p
                                        v-if="v$.formpassword.$error"
                                        class="block text-md text-red-500"
                                    >
                                        <!-- Digite uma password válida -->
                                    </p>
                                </div>
                                <div>
                                    <p>Confirme a password</p>
                                    <input
                                        type="password"
                                        v-model.trim="formpassword_confirmation"
                                        id="formpassword_confirmation"
                                        class="form-control"
                                        placeholder=""
                                    />
                                    <!-- <p
                                        v-if="
                                            v$.formpassword_confirmation.$error
                                        "
                                        class="block text-md text-red-500"
                                    >
                                        A confirmação é diferente da password
                                    </p> -->
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="button">
                                    <router-link
                                        class="bg-white focus:ring-4 border-2 font-medium rounded-md text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:focus:ring-blue-800"
                                        :to="{
                                            name: 'relatoriousuario',
                                        }"
                                    >
                                        Voltar</router-link
                                    >
                                </button>
                                <button
                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                    type="submit"
                                >
                                    Cadastrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { useVuelidate } from "@vuelidate/core";
import { required, minLength, email, sameAs } from "@vuelidate/validators";
import UsuarioDataService from "@/services/UsuarioDataService";

export default {
    name: "NovousuarioView",
    setup() {
        return {
            v$: useVuelidate(),
        };
    },
    data() {
        return {
            formnome: "",
            formemail: "",
            formpassword: "",
            formpassword_confirmation: "",
            errorserver: "",
        };
    },
    validations() {
        return {
            formnome: { required },
            formemail: { required },
            formpassword: { required },
            formpassword_confirmation: { required },
        };
    },
    methods: {
        // Soumission du formulaire
        actionnovousuario: async function () {
            console.log("fdfdfd");

            this.v$.$touch();

            if (this.v$.$invalid) {
                // Si le formulaire est invalide, arrêtez le processus de soumission
                this.errorserver = "";
                return;
            }

            try {
                this.$emit("loading:start");
                const response = await UsuarioDataService.criar({
                    nome: this.formnome,
                    email: this.formemail,
                    password: this.formpassword,
                    password_confirmation: this.formpassword_confirmation,
                });
                // this.$router.push({ name: "relatoriousuario" });
                this.formnome = "";
                this.formemail = "";
                this.formpassword = "";
                this.formpassword_confirmation = "";
                //console.log(response.data.message);
                this.errorserver = response.data.message;
            } catch (erro) {
                this.errorserver = "Email ja existente !!!";
            } finally {
                this.$emit("loading:end");
            }
        },
    },
};
</script>
