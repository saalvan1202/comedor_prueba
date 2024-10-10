<template>
  <RouterView />
</template>
<script setup>
import { ref, computed } from "vue";
import { RouterLink, RouterView } from "vue-router";
//VAIRABLE DE CONTENIDO DENÁMICO
const visible = ref(true);
const miNombre = "Shande Andres Alvan Rios";
const miEdad = 20;
let color = ref("rojo");
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

<style scoped></style>
<!-- <h1 v-bind:style="color">Nombre: {{ miNombre }}</h1>
  <h1 :style="color">Nombre: {{ miNombre }}</h1>
  <h2>Edad: {{ miEdad }}</h2>
  <h3 :class="color">Contador: {{ constador }}</h3>
  <p v-if="constador > 6">Sigue dandole papi</p>
  <p v-else-if="constador > 3">Masomenos papi</p>
  <p v-else>Muestrame lo que tienes</p>
  <p v-show="comprobacion">Holo papi</p>
  <button v-on:click="contador">Click</button>
  <button @click="Saludar">Click</button> 
  <Productos />-->
