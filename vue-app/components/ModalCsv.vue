<template>
  <!-- Modal -->
  <div class="modal fade" :id="modalId" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="importModalLabel">Importar CSV</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="text" class="form-control mb-3" v-model="separator" placeholder="Informe o separador do CSV" />
            <input type="file" class="form-control" @change="handleFileUpload" accept=".csv" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" @click="importCSV">Importar</button>
          </div>
        </div>
      </div>
    </div>
</template>
  
<script setup>

const props = defineProps({
  modalId: {
    type: String,
    required: true,
  }
})

const file = ref(null)
const separator = ref(null)

const handleFileUpload = (event) => {
  file.value = event.target.files[0]
}

const importCSV = async () => {
  if (file.value) {

    const formData = new FormData()
    formData.append('file', file.value)
    formData.append('separator', separator.value ?? ';')
    
    try {
      const response = await fetch('http://localhost:9000/api/distance/import-csv', {
        method: 'POST',
        body: formData
      })

      if (!response.ok) {
        alert('Falha ao importar CSV')
      }

      const result_count = await response.text()
      alert(`Importação bem-sucedida: foram importados ${result_count} registros`)
    } catch (error) {
      alert('Erro ao importar CSV:', error)
    }
  }
  const importModal = bootstrap.Modal.getInstance(document.getElementById(props.modalId))
  importModal.hide()
}
</script>