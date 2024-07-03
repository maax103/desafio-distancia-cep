<template>
  <div class="container">
    <div class="row">
      <div class="col">Distância entre CEPs cadastrados</div>
      <div class="col-md-auto">
        <AddButton :showForm="showForm" @update-form="handleShowForm" />
      </div>
    </div>
    <AddForm v-if="showForm" @submitted="window.reload()" @close-form="handleShowForm(false)" />
    <TableComponent :items="tableItems" />
    <p v-if="error">{{ errorMessage }}</p>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import AddForm from '~/components/AddForm.vue'
import AddButton from '~/components/AddButton.vue'
import TableComponent from '~/components/TableComponent.vue'

const showForm = ref(false)
const tableItems = ref([])
const error = ref(null)
const errorMessage = ref('')

const fetchData = async () => {
  try {
    const response = await fetch('http://localhost:9000/api/distance/list')
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`)
    }
    const data = await response.json()
    tableItems.value = data
  } catch (err) {
    error.value = true
    errorMessage.value = 'Failed to fetch distances. Please try again later.'
  }
}

onMounted(() => {
  fetchData()
})

const handleShowForm = (status) => {
  showForm.value = status
}

</script>
