@extends('layouts.front')

@section('css')
    <style>
        .form-group {
            margin-bottom: 1rem;
        }
    </style>
@endsection

@section('title', 'Hakkımızda')

@section('content')
    <h1>Hakkımızda</h1>
    <br>

    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Kullanıcı Bilgilerini Güncelle</h4>
                    </div>
                    <div class="card-body">
                        <form id="userUpdateForm" action="{{ route('user.update', ['id' => 1]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Adınız</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Adınız" required>
                                <div class="invalid-feedback" id="nameError"></div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                    required>
                                <div class="invalid-feedback" id="emailError"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">Güncelle</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Güncelleme Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Güncellenecek Bilgiler</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Ad:</th>
                                    <td id="modalName"></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td id="modalEmail"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-primary" id="confirmUpdate">Güncelle</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            // CSRF token ayarı
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Form gönderimi
            $('#userUpdateForm').on('submit', function (e) {
                e.preventDefault();

                // Hata mesajlarını temizle
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').text('');

                // Form verilerini al
                let formData = {
                    name: $('#name').val(),
                    email: $('#email').val()
                };

                // Modal'da verileri göster
                $('#modalName').text(formData.name);
                $('#modalEmail').text(formData.email);

                // Modal'ı aç
                var modal = new bootstrap.Modal(document.getElementById('updateModal'));
                modal.show();

                // Güncelleme onayı
                $('#confirmUpdate').on('click', function () {
                    // Form verilerini sunucuya gönder
                    $.ajax({
                        type: "PUT",
                        url: "{{ route('user.update', ['id' => 1]) }}",
                        data: formData,
                        success: function (response) {
                            // Modal'ı kapat
                            modal.hide();

                            // Başarı mesajı göster
                            Swal.fire({
                                title: 'Başarılı!',
                                text: 'Bilgileriniz başarıyla güncellendi.',
                                icon: 'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Sayfayı yenile
                                    window.location.reload();
                                }
                            });
                        },
                        error: function (error) {
                            // Modal'ı kapat
                            modal.hide();

                            if (error.status === 422) {
                                // Validasyon hataları
                                let errors = error.responseJSON.errors;
                                Object.keys(errors).forEach(function (key) {
                                    $('#' + key).addClass('is-invalid');
                                    $('#' + key + 'Error').text(errors[key][0]);
                                });
                            } else {
                                // Genel hata mesajı
                                Swal.fire({
                                    title: 'Hata!',
                                    text: 'Güncelleme işlemi sırasında bir hata oluştu.',
                                    icon: 'error'
                                });
                            }
                        }
                    });
                });
            });
        });
    </script>
@endsection