<template>
  <div class="container">
    <div class="row">
      <div class="col">Distância entre CEPs cadastrados</div>
      <div class="col-md-auto">
        <AddButton :showForm="showForm" @update-form="handleShowForm" />
      </div>
    </div>
    <AddForm v-if="showForm" @submitted="pushItem" @close-form="handleShowForm(false)" />
    <TableComponent :items="tableItems" />
  </div class="container">
</template>
  
<script>
  import AddForm from '~/components/AddForm.vue';
  import AddButton from '~/components/AddButton.vue';
  import TableComponent from '~/components/TableComponent.vue';
  import RowComponent from '~/components/RowComponent.vue';
  
  export default {
    components: {
      AddForm,
      AddButton,
      TableComponent,
      RowComponent,
    },
    data() {
      return {
        showForm: false,
        tableItems: [],
      };
    },
    methods: {
      pushItem(info) {
        this.tableItems = [
          ...this.tableItems, 
          {
            id: this.tableItems.length,
            cep1: info.cep1,
            cep2: info.cep2,
          }
        ]
        this.showForm = false;
      },
      handleShowForm(status) {
        this.showForm = status;
      }
    }
  };
</script>

<style scoped>
/* Adicione estilos específicos para o componente aqui, se necessário */
</style>
  