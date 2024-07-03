<template>
  <tr>
    <td>{{ item.id }}</td>
    <td>{{ item.cep1 }}</td>
    <td>{{ item.cep2 }}</td>
    <td>{{ item.distance }}</td>
    <td>{{ item.date_created }}</td>
    <td>{{ item.date_modification }}</td>
    <td>+</td>
  </tr>
</template>

<script>
  export default {
    props: {
        item: {
            type: Object,
            required: true,
        }
    }
  }
</script>