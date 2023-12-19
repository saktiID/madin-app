<x-menu-item-heading menuHeadingName="ADMINISTRASI" />

<x-menu-item menuTitle="Identitas" menuIcon="briefcase" route="identitas" classActive="identitas" />

<x-menu-item-dropdown menuTitle="Master Data" menuId="master-data" menuIcon="database" classActive="master-data/*">
    <x-sub-menu-item menuTitle="Data Asatidz" classActive="master-data/data-asatidz" route="data-asatidz" />
    <x-sub-menu-item menuTitle="Data Santri" classActive="master-data/data-santri" route="data-santri" />
    <x-sub-menu-item menuTitle="Data Pelajaran" classActive="master-data/data-pelajaran" route="data-pelajaran" />
    <x-sub-menu-item menuTitle="Data Kelas" classActive="master-data/data-kelas" route="data-kelas" />
    <x-sub-menu-item menuTitle="Data Periode" classActive="master-data/data-periode" route="data-periode" />
</x-menu-item-dropdown>

<x-menu-item-dropdown menuTitle="Raport" menuId="raport" menuIcon="archive" classActive="raport/*">
    <x-sub-menu-item menuTitle="Kelas 1 Ibtida'" classActive="raport/kelas/uniq_id-1" route="raport-kelas" param="uniq_id-1" />
    <x-sub-menu-item menuTitle="Kelas 2 Ibtida'" classActive="raport/kelas/uniq_id-2" route="raport-kelas" param="uniq_id-2" />
</x-menu-item-dropdown>

<x-menu-item menuTitle="Log" menuIcon="pocket" route="log" classActive="log" />
