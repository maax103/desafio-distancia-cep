<template>
  <div class="dropdown">
    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
      Ações
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
      <li><button class="dropdown-item" @click="emitUpdateShowForm(true)">Adicionar um item</button></li>
      <li><button class="dropdown-item" @click="openImport">Importar CSV</button></li>
    </ul>
    
    <ModalCsv :modalId="'importModal'"/>
  </div>
</template>

<script setup>
import ModalCsv from '~/components/ModalCsv.vue'

const emit = defineEmits(['update-form'])

const emitUpdateShowForm = (status) => {
  emit('update-form', status)
}

const openImport = () => {
  const importModal = new bootstrap.Modal(document.getElementById('importModal'))
  importModal.show()
}
</script>
