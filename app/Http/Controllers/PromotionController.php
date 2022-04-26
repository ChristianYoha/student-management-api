<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromotionFormRequest;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends ApiResponseStatusController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if( $promotions = Promotion::all() ){
            return $this->success(null, $promotions);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( PromotionFormRequest $promotionRequest)
    {
        //
        $newPromotion = Promotion::create($promotionRequest->all());

        if($newPromotion){
            return $this->success('Promotion ajoutée avec succès', $newPromotion);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        if($promotion){
            // add the students to returned datas
            $promotion->students;
            return $this->success(null, $promotion);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(PromotionFormRequest $promotionRequest, Promotion $promotion)
    {
        //
        $promotion->name = $promotionRequest->get('name');
        $promotion->endYear = $promotionRequest->get('endYear');
        if ($promotion->update()){
            return $this->success('Promotion modifiée avec succès', $promotion);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Promotion $promotion)
    // {
    //     //
    //     if ($promotion->delete()) {
    //         return $this->success('Promotion supprimée avec succès',null);
    //     }
    //     return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    // }
}
