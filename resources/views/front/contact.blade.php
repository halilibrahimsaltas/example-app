@extends('layouts.front')

@section('css')
    <style>
        .form-group {
            margin-bottom: 1rem;
        }
    </style>
@endsection

@section('title', 'İletişim')

@section('content')
    <h1>İletişim</h1>
    <br>

    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>

    <div class="container">
        <form id="contactForm" action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Adınız</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Adınız">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="message">Mesaj</label>
                <textarea name="message" id="message" class="form-control" placeholder="Mesaj"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gönder</button>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="formDataModal" tabindex="-1" aria-labelledby="formDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formDataModalLabel">Form Verileri</h5>
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
                                <tr>
                                    <th>Mesaj:</th>
                                    <td id="modalMessage"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Destek Talebi</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <form id="supportForm" action="{{ route('support-form') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="supportName">Adınız</label>
                <input type="text" name="name" id="supportName" class="form-control" placeholder="Adınız">
            </div>
            <div class="form-group">
                <label for="supportEmail">Email</label>
                <input type="email" name="email" id="supportEmail" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="supportMessage">Mesaj</label>
                <textarea name="message" id="supportMessage" class="form-control" placeholder="Mesaj"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gönder</button>
        </form>
    </div>

    <!-- Destek Formu Modal -->
    <div class="modal fade" id="supportFormModal" tabindex="-1" aria-labelledby="supportFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="supportFormModalLabel">Destek Talebi Bilgileri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Ad:</th>
                                    <td id="supportModalName"></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td id="supportModalEmail"></td>
                                </tr>
                                <tr>
                                    <th>Mesaj:</th>
                                    <td id="supportModalMessage"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // İletişim formu işlemleri
            $('#contactForm').on('submit', function (e) {
                e.preventDefault();

                let formData = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    message: $('#message').val()
                };

                // Modal'da verileri göster
                $('#modalName').text(formData.name);
                $('#modalEmail').text(formData.email);
                $('#modalMessage').text(formData.message);

                // Modal'ı aç
                var modal = new bootstrap.Modal(document.getElementById('formDataModal'));
                modal.show();

                // Form verilerini sunucuya gönder
                $.ajax({
                    type: "POST",
                    url: "{{ route('contact.submit') }}",
                    data: formData,
                    success: function (response) {
                        console.log('Başarılı:', response);
                        Swal.fire({
                            title: 'Başarılı!',
                            text: 'Form başarıyla gönderildi.',
                            icon: 'success'
                        });
                    },
                    error: function (error) {
                        console.log('Hata:', error);
                        Swal.fire({
                            title: 'Hata!',
                            text: 'Form gönderilirken bir hata oluştu.',
                            icon: 'error'
                        });
                    }
                });
            });

            // Destek formu işlemleri
            $('#supportForm').on('submit', function (e) {
                e.preventDefault();

                let formData = {
                    name: $('#supportName').val(),
                    email: $('#supportEmail').val(),
                    message: $('#supportMessage').val()
                };

                // Modal'da verileri göster
                $('#supportModalName').text(formData.name);
                $('#supportModalEmail').text(formData.email);
                $('#supportModalMessage').text(formData.message);

                // Modal'ı aç
                var modal = new bootstrap.Modal(document.getElementById('supportFormModal'));
                modal.show();

                // Form verilerini sunucuya gönder
                $.ajax({
                    type: "POST",
                    url: "{{ route('support-form') }}",
                    data: formData,
                    success: function (response) {
                        console.log('Başarılı:', response);
                        Swal.fire({
                            title: 'Başarılı!',
                            text: 'Destek talebiniz başarıyla gönderildi.',
                            icon: 'success'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#supportForm')[0].reset();
                            }
                        });
                    },
                    error: function (error) {
                        console.log('Hata:', error);
                        let errorMessage = 'Destek talebi gönderilirken bir hata oluştu.';

                        if (error.responseJSON && error.responseJSON.message) {
                            errorMessage = error.responseJSON.message;
                        }

                        Swal.fire({
                            title: 'Hata!',
                            text: errorMessage,
                            icon: 'error'
                        });
                    }
                });
            });
        });
    </script>
@endsection