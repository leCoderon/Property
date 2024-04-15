<form action="{{ route('property.contact', $property) }}" method="post">
    @csrf
    @method('post')
    <div class="row">
        <div class="col-sm-12 col-md-6 mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your Last Name" name="name" />
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-sm-12 col-md-6 mb-3">
            <input type="text" class="form-control @error('surname') is-invalid @enderror" placeholder="Your First name" name="surname" />
            @error('surname')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-sm-12 col-md-6 mb-3">
            <input type="number" class="form-control @error('phone') is-invalid @enderror" placeholder="Your phone number" name="phone" />
            @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-sm-12 col-md-6 mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email" name="email" />
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-12 mb-3">
            <textarea  name="message" id="" cols="30" rows="7" class="form-control @error('message') is-invalid @enderror" placeholder="Message"></textarea>
            @error('message')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-12">
            <input type="submit" value="Send Message" class="btn btn-primary" />
        </div>
    </div>
</form>
