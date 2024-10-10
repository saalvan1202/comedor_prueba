<script setup>
import { productos } from "./arrays";
console.log(productos);
let clase = "delete";
//DEIFINIMOS LOS PROPS
const props = defineProps({
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
</script>
<template>
  <Card hoverable style="width: 300px">
    <template #cover>
      <img alt="example" :src="imagen" height="200px" />
    </template>
    <template class="ant-card-actions" #actions>
      <edit-outlined key="edit" title="Editar" />
      <delete-outlined
        key="delete"
        class="delete"
        title="Eliminar"
        :class="colors"
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
