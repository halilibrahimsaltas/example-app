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
        <form id="contactForm">
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
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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
        });
    </script>
@endsection