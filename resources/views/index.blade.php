<x-layouts.app :title="'Home Page'">
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-4">Welcome to the Home Page!</h1>
        <p>This is a simple page using the app layout.</p>

        <x-button variant="primary" class="mt-4">Get Started</x-button>
        <x-bladewind::code />
        <x-bladewind::table has_border="true" divider="thin">
            <x-slot name="header">
                <th>Name</th>
                <th>Department</th>
                <th>Email</th>
            </x-slot>
            <tr>
                <td>Alfred Rowe</td>
                <td>Outsourcing</td>
                <td>alfred@therowe.com</td>
            </tr>
            <tr>
                <td>Michael K. Ocansey</td>
                <td>Tech</td>
                <td>kabutey@gmail.com</td>
            </tr>
        </x-bladewind::table>
    </div>
</x-layouts.app>