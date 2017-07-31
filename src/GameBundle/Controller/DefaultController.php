<?php

namespace GameBundle\Controller;

use GameBundle\Form;
use GameBundle\RockPaperScissors\Card\CardType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        return $this->render('GameBundle:Default:index.html.twig');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function solveAction(Request $request)
    {
        $result = array();
        if ($card = CardType::getCardByNameList($request->get('card'))) {
            $result['result'] = $this->get('rock.paper.scissors')->solve($card);
            $result['opponent'] = $this->get('rock.paper.scissors')->getOpponentCard()->getName();

        } else {
            $result['error'] = 'Wrong type';
        }

        return new JsonResponse($result);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function listCardAction(Request $request)
    {
        return new JsonResponse(array('list' => CardType::getNamedCardList()));
    }
}
