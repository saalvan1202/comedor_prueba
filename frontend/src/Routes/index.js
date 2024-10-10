import { createRouter, createWebHistory } from "vue-router";
import Productos from "@/modules/Inventario/Productos.vue";
import PantallaPrincipal from "@/modules/Salon/PantallaPrincipal.vue";
import App from "@/App.vue";
const routes = [
  {
    path: "/",
    name: "inicio",
    component: PantallaPrincipal,
  },
  {
    path: "/productos",
    name: "productos",
    component: Productos,
  },
];
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: routes,
});
export default router;
