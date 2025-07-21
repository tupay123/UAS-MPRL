<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            window.location.href = "{{ route('ebooks.guest.download', $token) }}";
        },
        onPending: function(result){
            alert("Transaksi masih menunggu");
        },
        onError: function(result){
            alert("Terjadi kesalahan");
        }
    });
</script>
