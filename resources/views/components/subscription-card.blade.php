<div class="subscription-card">
    <div class="card-header">
        <h3>{{ $title }}</h3>
        <p class="price">{{ $price }}</p>
    </div>
    <div class="card-body">
        <ul>
            @foreach($features as $feature)
                <li>{{ $feature }}</li>
            @endforeach
        </ul>
    </div>
    <div class="card-footer">
        <input type="radio" name="subscription" value="{{ $value }}" id="subscription-{{ $value }}">
        <label for="subscription-{{ $value }}">Select</label>
    </div>
</div>

<style>
.subscription-card { border: 1px solid #ccc; padding: 1rem; margin-bottom: 1rem; }
.card-header { font-weight: bold; }
.price { color: #1f2937; }
.card-body ul { list-style: none; padding: 0; }
.card-footer { margin-top: 1rem; }
</style>

{{-- 
used :
blade
<x-subscription-card 
    title="Fundamental Monthly" 
    price="$59" 
    :features="['Learning Paths', 'Courses', 'Labs', 'Practice Exams']" 
    value="monthly"
/> --}}