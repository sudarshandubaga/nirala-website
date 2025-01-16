<style>
    .price-plan-section {
      background-color: #fff;
      padding: 50px 20px;
    }
    .price-plan-title {
      text-align: center;
      margin-bottom: 40px;
    }
    .price-card {
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #fff;
      transition: transform 0.3s ease;
      padding: 20px;
      text-align: center;
      cursor: pointer;
    }
    .price-card:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }
    .price-title {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 15px;
    }
    .price-details {
      font-size: 1rem;
      color: #666;
      margin-bottom: 10px;
    }
    .price-amount {
      font-size: 1.3rem;
      font-weight: 600;
      color: #000;
      margin-bottom: 15px;
    }
    .request-btn {
      font-size: 0.9rem;
      padding: 10px 20px;
      border-radius: 5px;
      background-color: #041656;
      color: #fff;
      text-transform: uppercase;
      text-decoration: none;
    }
    .request-btn:hover {
      background-color: #063ab5;
    }
  </style>

  @if (count($phase->new_price_list) > 0)
  <div class="price-plan-section">
    <h2 class="price-plan-title">{{$phase->name}} Price Plan</h2>
    
    <div class="container">
      <div class="row g-4">
        @foreach ($phase->new_price_list as $price)
        <div class="col-md-4">
          <div class="price-card m-2">
            <h3 class="price-title">{{$price->title}}</h3>
            <p class="price-details">Super Area<br>{{$price->size}}</p>
            <p class="price-amount">{{$price->price}}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @endif