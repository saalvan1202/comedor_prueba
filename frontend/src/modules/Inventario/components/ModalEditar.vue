<template>
  <div>
    <Modal
      :open="open"
      title="Editar Productos"
      @cancel="handleCancelar"
      width="650px"
    >
      <div class="modal-editar">
        <div class="edit-image">
          <img
            src="https://origin.cronosmedia.glr.pe/large/2020/09/26/lg_5f6f54362c629774da0419a5.jpg"
            alt=""
            height="300px"
            width="300px"
          />
          <input type="file" />
        </div>
        <div>
          <section class="form">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" />
          </section>
          <section class="form">
            <label for="descripcion">Descripcion:</label>
            <input type="text" id="descripcion" />
          </section>
          <section class="form">
            <label for="precio">Precio:</label>
            <input type="text" id="precio" />
          </section>
        </div>
      </div>
    </Modal>
  </div>
</template>
<script setup>
import { Button } from "ant-design-vue";
import { Modal } from "ant-design-vue";
import { ref } from "vue";
const props = defineProps({
  open: { type: Boolean },
  handleCancelar: {
    type: Function,
  },
});
</script>
<style scoped>
.edit-image {
  img {
    border-radius: 5px;
  }
}
.modal-editar {
  padding-top: 20px;
  border-top: 1px solid black;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
}

.form {
  display: flex;
  flex-direction: column;
  input {
    border-radius: 5px;
    height: 5vh;
    width: 38.6vh;
    border: 1px solid black;
  }
}
</style>
