<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class WebPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'es_slug',
        'ca_slug',
        'en_slug',
        'name',
        'description',
        'content',
        'seo',
        'meta',
        'active'

    ];
    protected $casts = [
        'meta' => 'array',
        'seo' => 'array',
        'name' => 'array',
        'description' => 'array',
        'content' => 'array',
        'active' => 'boolean'
    ];

    // Attributes
    public function getActiveIconAttribute() {        
        return $this->active ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-cross text-danger"></i>';
    }
    public function getRelatedProductAttribute() {
        $d = $this->meta;
        return $d['productId'] ?? null;
    }
    public function setRelatedProductAttribute( $value ) {
        $d = $this->meta;
        $d['productId'] = $value;
        $this->meta = $d;
    }
    public function getTechNameAttribute() {
        $d = $this->meta;
        return $d['techName'] ?? null;
    }
    public function setTechNameAttribute( $value ) {
        $d = $this->meta;
        $d['techName'] = $value;
        $this->meta = $d;
    }
    public function getFamilyAttribute() {
        $d = $this->meta;
        return $d['family'] ?? null;
    }
    public function setFamilyAttribute( $value ) {
        $d = $this->meta;
        $d['family'] = $value;
        $this->meta = $d;
    }
    public function getUbicationAttribute() {
        $d = $this->meta;
        return $d['ubication'] ?? null;
    }
    public function setUbicationAttribute( $value ) {
        $d = $this->meta;
        $d['ubication'] = $value;
        $this->meta = $d;
    }
    public function getComplexityAttribute() {
        $d = $this->meta;
        return $d['complexity'] ?? null;
    }
    public function setComplexityAttribute( $value ) {
        $d = $this->meta;
        $d['complexity'] = $value;
        $this->meta = $d;
    }
    public function getOriginCaAttribute() {
        $d = $this->meta;
        return $d['origin_ca'] ?? null;
    }
    public function setOriginCaAttribute( $value ) {
        $d = $this->meta;
        $d['origin_ca'] = $value;
        $this->meta = $d;
    }
    public function getOriginEsAttribute() {
        $d = $this->meta;
        return $d['origin_es'] ?? null;
    }
    public function setOriginEsAttribute( $value ) {
        $d = $this->meta;
        $d['origin_es'] = $value;
        $this->meta = $d;
    }
    public function getOriginEnAttribute() {
        $d = $this->meta;
        return $d['origin_en'] ?? null;
    }
    public function setOriginEnAttribute( $value ) {
        $d = $this->meta;
        $d['origin_en'] = $value;
        $this->meta = $d;
    }
    public function getOrigin( $locale=null ) {
        return $this->meta['origin_'.$locale??locale()] ?? '';
    }
    public function getTechsCaAttribute() {
        $d = $this->meta;
        return $d['techs_ca'] ?? null;
    }
    public function setTechsCaAttribute( $value ) {
        $d = $this->meta;
        $d['techs_ca'] = $value;
        $this->meta = $d;
    }
    public function getTechsEsAttribute() {
        $d = $this->meta;
        return $d['techs_es'] ?? null;
    }
    public function setTechsEsAttribute( $value ) {
        $d = $this->meta;
        $d['techs_es'] = $value;
        $this->meta = $d;
    }
    public function getTechsEnAttribute() {
        $d = $this->meta;
        return $d['techs_en'] ?? null;
    }
    public function setTechsEnAttribute( $value ) {
        $d = $this->meta;
        $d['techs_en'] = $value;
        $this->meta = $d;
    }
    public function getTechs( $locale=null ) {
        return $this->meta['techs_'.$locale??locale()] ?? '';
    }
    public function getCare1CaAttribute() {
        $d = $this->meta;
        return $d['care1_ca'] ?? null;
    }
    public function setCare1CaAttribute( $value ) {
        $d = $this->meta;
        $d['care1_ca'] = $value;
        $this->meta = $d;
    }
    public function getCare1EsAttribute() {
        $d = $this->meta;
        return $d['care1_es'] ?? null;
    }
    public function setCare1EsAttribute( $value ) {
        $d = $this->meta;
        $d['care1_es'] = $value;
        $this->meta = $d;
    }
    public function getCare1EnAttribute() {
        $d = $this->meta;
        return $d['care1_en'] ?? null;
    }
    public function setCare1EnAttribute( $value ) {
        $d = $this->meta;
        $d['care1_en'] = $value;
        $this->meta = $d;
    }
    public function getCare1( $locale=null ) {
        return $this->meta['care1_'.$locale??locale()] ?? '';
    }
    public function getCare2CaAttribute() {
        $d = $this->meta;
        return $d['care2_ca'] ?? null;
    }
    public function setCare2CaAttribute( $value ) {
        $d = $this->meta;
        $d['care2_ca'] = $value;
        $this->meta = $d;
    }
    public function getCare2EsAttribute() {
        $d = $this->meta;
        return $d['care2_es'] ?? null;
    }
    public function setCare2EsAttribute( $value ) {
        $d = $this->meta;
        $d['care2_es'] = $value;
        $this->meta = $d;
    }
    public function getCare2EnAttribute() {
        $d = $this->meta;
        return $d['care2_en'] ?? null;
    }
    public function setCare2EnAttribute( $value ) {
        $d = $this->meta;
        $d['care2_en'] = $value;
        $this->meta = $d;
    }
    public function getCare2( $locale=null ) {
        return $this->meta['care2_'.$locale??locale()] ?? '';
    }
    public function getCare3CaAttribute() {
        $d = $this->meta;
        return $d['care3_ca'] ?? null;
    }
    public function setCare3CaAttribute( $value ) {
        $d = $this->meta;
        $d['care3_ca'] = $value;
        $this->meta = $d;
    }
    public function getCare3EsAttribute() {
        $d = $this->meta;
        return $d['care3_es'] ?? null;
    }
    public function setCare3EsAttribute( $value ) {
        $d = $this->meta;
        $d['care3_es'] = $value;
        $this->meta = $d;
    }
    public function getCare3EnAttribute() {
        $d = $this->meta;
        return $d['care3_en'] ?? null;
    }
    public function setCare3EnAttribute( $value ) {
        $d = $this->meta;
        $d['care3_en'] = $value;
        $this->meta = $d;
    }
    public function getCare3( $locale=null ) {
        return $this->meta['care3_'.$locale??locale()] ?? '';
    }
    public function getAnnotationsCaAttribute() {
        $d = $this->meta;
        return $d['annotations_ca'] ?? null;
    }
    public function setAnnotationsCaAttribute( $value ) {
        $d = $this->meta;
        $d['annotations_ca'] = $value;
        $this->meta = $d;
    }
    public function getAnnotationsEsAttribute() {
        $d = $this->meta;
        return $d['annotations_es'] ?? null;
    }
    public function setAnnotationsEsAttribute( $value ) {
        $d = $this->meta;
        $d['annotations_es'] = $value;
        $this->meta = $d;
    }
    public function getAnnotationsEnAttribute() {
        $d = $this->meta;
        return $d['annotations_en'] ?? null;
    }
    public function setAnnotationsEnAttribute( $value ) {
        $d = $this->meta;
        $d['annotations_en'] = $value;
        $this->meta = $d;
    }
    public function getAnnotations( $locale=null ) {
        return $this->meta['annotations_'.$locale??locale()] ?? '';
    }



    public function getRelatedProductName( $locale=null ) {
        $id = $this->meta['productId'] ?? 0;
        if( $id ) {
            $product = \App\Models\Product::find($id);
            return $product->getLocalizedName($locale);
        }
        return '';
    }

    public function getNameEsAttribute() {
        $d = $this->name;
        return $d['es']??'';
    }
    public function setNameEsAttribute( $value ) {
        $d = $this->name;
        $d['es'] = $value;
        $this->name = $d;
    }
    public function getNameCaAttribute() {
        return $this->name['ca']??'';
    }
    public function setNameCaAttribute( $value ) {
        $d = $this->name;
        $d['ca'] = $value;
        $this->name = $d;
    }
    public function getNameEnAttribute() {
        return $this->name['en']??'';
    }
    public function setNameEnAttribute( $value ) {
        $d = $this->name;
        $d['en'] = $value;
        $this->name = $d;
    }
    public function getDescriptionEsAttribute() {
        return $this->description['es']??'';
    }
    public function setDescriptionEsAttribute( $value ) {
        $d = $this->description;
        $d['es'] = $value;
        $this->description = $d;
    }
    public function getDescriptionCaAttribute() {
        return $this->description['ca']??'';
    }
    public function setDescriptionCaAttribute( $value ) {
        $d = $this->description;
        $d['ca'] = $value;
        $this->description = $d;
    }
    public function getDescriptionEnAttribute() {
        return $this->description['en']??'';
    }
    public function setDescriptionEnAttribute( $value ) {
        $d = $this->description;
        $d['en'] = $value;
        $this->description = $d;
    }
    public function getSeoTitleEsAttribute() {
        return $this->seo['title']['es']??'';
    }
    public function setSeoTitleEsAttribute( $value ) {
        $d = $this->seo;
        $d['title']['es'] = $value;
        $this->seo = $d;
    }
    public function getSeoTitleCaAttribute() {
        return $this->seo['title']['ca']??'';
    }
    public function setSeoTitleCaAttribute( $value ) {
        $d = $this->seo;
        $d['title']['ca'] = $value;
        $this->seo = $d;
    }
    public function getSeoTitleEnAttribute() {
        return $this->seo['title']['en']??'';
    }
    public function setSeoTitleEnAttribute( $value ) {
        $d = $this->seo;
        $d['title']['en'] = $value;
        $this->seo = $d;
    }
    public function getSeoDescriptionEsAttribute() {
        return $this->seo['description']['es']??'';
    }
    public function setSeoDescriptionEsAttribute( $value ) {
        $d = $this->seo;
        $d['description']['es'] = $value;
        $this->seo = $d;
    }
    public function getSeoDescriptionCaAttribute() {
        return $this->seo['description']['ca']??'';
    }
    public function setSeoDescriptionCaAttribute( $value ) {
        $d = $this->seo;
        $d['description']['ca'] = $value;
        $this->seo = $d;
    }
    public function getSeoDescriptionEnAttribute() {
        return $this->seo['description']['en']??'';
    }
    public function setSeoDescriptionEnAttribute( $value ) {
        $d = $this->seo;
        $d['description']['en'] = $value;
        $this->seo = $d;
    }
    public function getContentEsAttribute() {
        return $this->content['es']??'';
    }
    public function setContentEsAttribute( $value ) {
        $d = $this->content;
        $d['es'] = $value;
        $this->content = $d;
    }
    public function getContentCaAttribute() {
        return $this->content['ca']??'';
    }
    public function setContentCaAttribute( $value ) {
        $d = $this->content;
        $d['ca'] = $value;
        $this->content = $d;
    }
    public function getContentEnAttribute() {
        return $this->content['en']??'';
    }
    public function setContentEnAttribute( $value ) {
        $d = $this->content;
        $d['en'] = $value;
        $this->content = $d;
    }
    public function getHeaderImageAttribute() {
        return $this->meta['header_image']??null;
    }
    public function setHeaderImageAttribute( $value ) {
        $d = $this->meta ?: array();
        $d['header_image'] = $value;
        $this->meta = $d;
    }

    // Methods
    public static function getBySlug( $slug ) {
        $locale = App::currentLocale();
        $page = WebPage::where($locale.'_slug',$slug)->where('active',true)->first();
        return $page;
    }
    public function getName($locale=null) {
        return $this->name[$locale??locale()] ?? '';
    }
    public function getDescription($locale=null) {
        return $this->description[$locale??locale()] ?? '';
    }
    public function getContent($locale=null) {
        return $this->content[$locale??locale()] ?? '';
    }
    public function getSeoTitle($locale=null) {
        return $this->seo['title'][$locale??locale()] ?? '';
    }
    public function getSeoDescription($locale=null) {
        return $this->seo['description'][$locale??locale()] ?? '';
    }
    public function getDate($locale=null) {
        return \App\Helpers\AppHelper::getDate($this->created_at, $locale);
    }
    public function getSlug($locale=null) {
        $l = ($locale??locale()).'_slug';
        return $this->$l;
    }
}
