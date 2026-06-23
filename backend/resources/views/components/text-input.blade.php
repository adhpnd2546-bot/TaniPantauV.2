@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-dark-border dark:bg-dark-card dark:text-dark-heading focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
