<template>
  <div class="border rounded">
    <div class="p-3">
      <h1 class="display-6">Registros</h1>
      <hr />
    </div>
    <table class="table table-striped mb-0">
      <template v-if="items.length">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Origem</th>
            <th scope="col">Destino</th>
            <th scope="col">Distância (km)</th>
            <th scope="col">Data/hora de cadastro</th>
            <th scope="col">Data/hora de alteração</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <RowComponent v-for="item in items" :key="item.id" :item="item" />
        </tbody>
      </template>
      <template v-else>
        <p>Não há nenhum item nos registros, por favor cadastre o seu primeiro registro.</p>
      </template>
    </table>
  </div>
</template>

<script>
  import RowComponent from '~/components/RowComponent.vue'

  export default {
    props: {
      items: {
        type: Object,
        required: true
      }
    }
  }
</script>