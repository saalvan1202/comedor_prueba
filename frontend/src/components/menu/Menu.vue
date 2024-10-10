<style scoped>
.menu {
  display: grid;
  grid-template-columns: 0.1fr 1fr;
  gap: 10px;
}
</style>
<template>
  <div class="menu">
    <Menu
      id="dddddd"
      v-model:openKeys="openKeys"
      v-model:selectedKeys="selectedKeys"
      style="width: 256px"
      mode="inline"
      :items="items"
      @click="handleClick"
    ></Menu>
    <slot name="contenido"></slot>
  </div>
</template>
<script setup>
import { reactive, ref, watch, h } from "vue";
import { useRouter } from "vue-router";
import { Menu } from "ant-design-vue";
import {
  MailOutlined,
  AppstoreOutlined,
  SettingOutlined,
} from "@ant-design/icons-vue";
//MANEJADOR DE RUTAS
const router = useRouter();
const handleClick = (e) => {
  const path = e.key;
  console.log(e);
  router.push({ path });
};

const selectedKeys = ref(["1"]);
const openKeys = ref(["sub1"]);
function getItem(label, key, icon, children, type) {
  return {
    key,
    icon,
    children,
    label,
    type,
  };
}
const items = reactive([
  getItem("Navigation One", "sub1", () => h(MailOutlined), [
    getItem(
      "Item 1",
      "g1",
      null,
      [getItem("Option 1", "1"), getItem("Option 2", "2")],
      "group"
    ),
    getItem(
      "Item 2",
      "g2",
      null,
      [getItem("Option 3", "3"), getItem("Option 4", "4")],
      "group"
    ),
  ]),
  getItem("Navigation Two", "sub2", () => h(AppstoreOutlined), [
    getItem("Option 5", "5"),
    getItem("Option 6", "6"),
    getItem("Submenu", "sub3", null, [
      getItem("Option 7", "7"),
      getItem("Option 8", "8"),
    ]),
  ]),
  {
    type: "divider",
  },
  getItem("Navigation Three", "sub4", () => h(SettingOutlined), [
    getItem("Option 9", "9"),
    getItem("Option 10", "10"),
    getItem("Option 11", "11"),
    getItem("Option 12", "12"),
  ]),
  getItem(
    "Group",
    "grp",
    null,
    [getItem("Productos", "productos"), getItem("Inicio", "/")],
    "group"
  ),
]);

watch(openKeys, (val) => {
  console.log("openKeys", val);
});
</script>
