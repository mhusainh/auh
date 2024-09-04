<a {{ $attributes }} 
   style="color: {{ $active ? '#ffffff' : '#B3B3B3' }};"
   onmouseover="this.style.color='#ffffff';" 
   onmouseout="this.style.color='{{ $active ? '#ffffff' : '#B3B3B3' }}';"
   aria-current="{{ $active ? 'page' : false }}">{{ $slot }}</a>
