<script setup>
import { productos } from "@/components/arrays";
import { ref, computed, onMounted, onBeforeMount } from "vue";
import CardProducto from "./components/CardProducto.vue";
import ModalEditar from "./components/ModalEditar.vue";
import Menu from "@/components/menu/Menu.vue";
import axios from "axios";
//ABRIRI Y CERRAR EL MODAL DE EDITAR
const openModal = ref(false);
console.log(openModal);
function handleCancelar() {
  openModal.value = false;
}
function openModalEditar() {
  console.log(openModal);
  openModal.value = true;
}
//VAIRABLE DE CONTENIDO DENÁMICO
const visible = ref(true);
const miNombre = "Shande Andres Alvan Rios";
const miEdad = 20;
let color = ref("rojo");

//PRIMERA LLAMADA DE API
//onMounted() se ejcuta después de montarse en el DOM
//onBeforeMount se ejecuta antes de mostarse en el DOM
onBeforeMount(() => {
  const getAxios = async () => {
    try {
      const productos = await axios.get("http://127.0.0.1:8000/api/productos");
      console.log("Solicitud correcta:", productos.data);
    } catch (error) {
      console.log(error);
    }
  };
  getAxios();
});
const comprobacion = computed(() => {
  return constador.value === 0;
});
const mensage = "Hola Mundo!";
//Las varaibles reactivas son las que cambian con el tiempo, o van dirigidos a eventos
let constador = ref(0);
function contador() {
  constador.value++;
  visible.value = constador.value === 0;
  if (constador.value > 6) {
    color.value = "azul";
  }
}
//Para modificr el valor de una variavle reactiva, tenemos que poner value

function Saludar() {
  return console.log(mensage);
}
</script>
<template>
  <Menu>
    <template #contenido>
      <div class="card">
        <section class="title">
          <h1>Productos</h1>
        </section>
        <div class="card-productos">
          <CardProducto
            v-for="(producto, index) in productos"
            :open-modal-editar="openModalEditar"
            :titulo="producto.titulo"
            :descripcion="producto.descripcion"
            :precio="producto.precio"
            :imagen="producto.imagen"
          />
        </div>
      </div>
    </template>
  </Menu>
  <ModalEditar :open="openModal" :handle-cancelar="handleCancelar" />
</template>

<style scoped>
.card {
  display: grid;
  grid-template-rows: 0.1fr 1fr;
}
.title {
  color: #818181;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 5vh;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
    Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  border-bottom: 1px solid #818181;
  margin: 0 100px 20px 100px;
}

.card-productos {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
}
</style>
