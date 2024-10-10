<script setup>
import { productos } from "@/components/arrays";
import ModalEditar from "./ModalEditar.vue";
console.log(productos);
let clase = "delete";
//DEIFINIMOS LOS PROPS
const props = defineProps({
  openModalEditar: {
    type: Function,
  },
  titulo: {
    type: String,
    requerid: true,
  },
  descripcion: {
    type: String,
    requerid: true,
  },
  precio: {
    type: Number,
    requerid: true,
  },
  imagen: {
    type: String,
  },
});
import {
  SettingOutlined,
  EditOutlined,
  EllipsisOutlined,
  DeleteOutlined,
} from "@ant-design/icons-vue";
import { defineComponent } from "vue";
import { Avatar, Card, CardMeta } from "ant-design-vue";
//FUNCIONES
function onEditar() {}
function onEliminar() {
  console.log("Eliminando");
}
</script>
<template>
  <Card hoverable style="width: 280px">
    <template #cover>
      <img alt="example" :src="imagen" height="200px" />
    </template>
    <template class="ant-card-actions" #actions>
      <edit-outlined key="edit" title="Editar" @click="openModalEditar" />
      <delete-outlined
        key="delete"
        class="delete"
        title="Eliminar"
        @click="onEliminar"
      />
    </template>
    <CardMeta :title="titulo" :description="descripcion">
      <template #avatar> </template>
    </CardMeta>
    <p>
      <strong>Precio: S/{{ precio }}</strong>
    </p>
  </Card>
</template>
<style scoped>
p {
  margin-left: 15px;
}
.delete:hover {
  color: red;
}
</style>
