<template>
  <div class="dropdown">
    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
      
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
      <li><button class="dropdown-item" @click="updateShowForm(true)">Adicionar um item</button></li>
      <li><button class="dropdown-item"@click="openImport">Importar CSV</button></li>
    </ul>
  </div>
</template>

<script>
export default {
  methods: {
      updateShowForm(status) {
          this.$emit('update-form', status)
      },
      openImport() {
        console.log('iniciar importação')
      }
  }
}
</script>
