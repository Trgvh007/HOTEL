@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif


<x-fetchroom>
    <x-slot name='title'> Chuyển phòng</x-slot> 
  
<div class="container">
  
    <div class="header">Chuyển phòng - R.{{ $oldRoom }}</div>

    <div class="content">
      <h3>Chuyển đến</h3>

      <form method="POST" action="{{ route('chuyen-phong.submit') }}">
      @csrf
      <input type="hidden" name="old-room" value="{{ $oldRoom }}">
      <div class="form-group">
        <label for="room-type">Loại phòng:</label>
    <select name="room-type" onchange ="fetchRooms()">
    <option value="">Chọn loại</option>
    @foreach($roomTypes as $type)
            <option value="{{ $type->ID_Loai }}">{{ $type->ten_loai }}</option>
          @endforeach
        </select>
      </div>

    
      <div class="form-group">
        <label for="room-number">Phòng:</label>
        <select name="room-number">
               <option value="">Chọn phòng</option>
  </select>
  </div>

      <div class="buttons">
      <button type="button" class="cancel-button" onclick="window.location.href='{{ route('booking.list') }}'">Cancel</button>
        <button type="submit" class="confirm-button" name="submit">Chuyển</button>
      </div>
  </form>
    </div>
  </div>

</x-fetchroom>