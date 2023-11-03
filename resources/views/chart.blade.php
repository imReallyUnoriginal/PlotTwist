<div>
    <canvas id="{{ $id }}"></canvas>
</div>

<script>
    const ctx = document.getElementById('{{ $id }}');

    new Chart(ctx, {
        type: '{{ $type }}',
        data: {
            labels: JSON.parse('{!! json_encode($labels) !!}'),
            datasets: JSON.parse('{!! json_encode($datasets) !!}')
        },
        options: JSON.parse('{!! json_encode($options) !!}')
    });
</script>
