import { createRouter, createWebHistory } from "vue-router"; ///

const Apresentacao = () => import("./view/Apresentacao.vue");
const Login = () => import("./view/LoginView.vue");
const Novousuario = () => import("./view/NovousuarioView.vue");
const Editausuario = () => import("./view/EditausuarioView.vue");
const RelatorioUsuario = () => import("./view/RelatorioUsuarioView.vue");
const RelatorioCliente = () => import("./view/RelatorioClienteView.vue");
const NovoCliente = () => import("./view/NovoClienteView.vue");
const EditaCliente = () => import("./view/EditaclienteView.vue");

const routes = [
    {
        name: "home",
        path: "/",
        component: Apresentacao,
    },
    {
        name: "login",
        path: "/login",
        component: Login,
    },
    {
        name: "novousuario",
        path: "/novousuario",
        component: Novousuario,
    },
    {
        name: "editausuario",
        path: "/usuario/:id",
        component: Editausuario,
    },
    {
        name: "relatoriousuario",
        path: "/usuario",
        component: RelatorioUsuario,
    },
    {
        name: "novocliente",
        path: "/novocliente",
        component: NovoCliente,
    },
    {
        name: "relatoriocliente",
        path: "/cliente",
        component: RelatorioCliente,
    },
    {
        name: "editacliente",
        path: "/cliente/:id",
        component: EditaCliente,
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;
