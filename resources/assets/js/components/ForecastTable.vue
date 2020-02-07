<template>
<div>
    <table>
        <thead>
            <tr>
                <th>Month Year</th>
                <th>Number of studies</th>
                <th>Cost forecasted</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in formattedForecast" v-bind:key="item.timestamp">
                <td>{{ item.timestamp }}</td>
                <td>{{ item.numberOfStudiesPerMonth }}</td>
                <td>{{ item.costPerMonth }}</td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
const numberFormatter = new Intl.NumberFormat('en-US');
const currencyFormatter = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' });

export default {
    props: ['forecast'],
    computed: {
        formattedForecast() {
            return this.forecast.map(({
                timestamp,
                numberOfStudiesPerMonth,
                costPerMonth,
            }) => ({
                timestamp,
                numberOfStudiesPerMonth: numberFormatter.format(numberOfStudiesPerMonth),
                costPerMonth: currencyFormatter.format(costPerMonth),
            }));
        }
    }
}
</script>

<style scoped>
    table {
        margin-bottom: 30px;
    }
    th {
        padding: 0 20px;
    }
</style>