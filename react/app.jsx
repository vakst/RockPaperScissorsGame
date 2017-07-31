import React from 'react';
import ReactDOM from 'react-dom';
import * as $ from 'jquery';
import createReactClass from 'create-react-class'


var Game = createReactClass({
    getInitialState: function() {
        return {
            cards: [],
            userChoice: "",
            opponentChoice: "",
            result: ""
        }
    },
    componentWillMount: function() {
        this.loadCardsFromServer();
    },
    loadCardsFromServer: function () {
        $.ajax({
            url: '/card/list',
            success: function (data) {
                this.setState({cards: data.list});
            }.bind(this)
        });
    },
    updateResultTable: function (response) {
        this.state.userChoice = response.userChoice
        this.state.opponentChoice = response.opponentChoice
        this.state.result = response.result
        this.setState(this.state)

    },
    render: function() {
        var that = this;
        var cards = this.state.cards.map(function (cardId) {
            return (
                <CardBox imlUrl={"/img/card/" + cardId + ".jpg"} id={cardId} key={cardId} gameDoneCallback={that.updateResultTable}></CardBox>
            );
        });
        var cardsStatistic = this.state.cards.map(function (cardId) {
            return (
                <GameCardsStatisticSection id={cardId} key={cardId} userChoice={that.state.userChoice} opponentChoice={that.state.opponentChoice}></GameCardsStatisticSection>
            );
        });
        return (
            <div className="row">
                <GameResult userChoice={this.state.userChoice} opponentChoice={this.state.opponentChoice} gameResult={this.state.result} />
                {cards}
                <GameStatisticSection gameResult={this.state.result} />
                {cardsStatistic}
            </div>
        );
    }
})

/**
 * Current game information
 */
var GameResult = createReactClass({
    render: function() {
        return (
            <section>
                <div className={"col-xs-12 " + (this.props.userChoice ? '' : 'hidden')}>You: {this.props.userChoice}</div>
                <div className={"col-xs-12 " + (this.props.userChoice ? '' : 'hidden')}>Computer: {this.props.opponentChoice}</div>
                <div className={"col-xs-12 " + (this.props.userChoice ? '' : 'hidden')}>Result: {this.props.gameResult}</div>
            </section>
        )
    }
})

/**
 * Separate card
 */
var CardBox = createReactClass({
    makeChoice: function() {
        var id = this.props.id;
        //this.props.gameDoneCallback({userChoice: id, opponentChoice: "", result: ""});

        $.ajax({
            url: '/solve/' + id,
            type: 'POST',
            success: function (data) {
                this.props.gameDoneCallback({userChoice: id, opponentChoice: data.opponent, result: data.result});
            }.bind(this)
        });
    },
    render: function() {
        return (
            <div id={this.props.id} className="col-lg-4 col-md-4 col-xs-6"><a className="thumbnail" href="#" onClick={this.makeChoice}><img className="img-responsive" src={this.props.imlUrl} /></a></div>
        )
    }
})

/**
 * Total game statistic
 */
var GameStatisticSection = createReactClass({
    getInitialState: function() {
        return {
            total: 0,
            wonTimes: 0,
            lostTimes: 0,
            drawTimes: 0
        }
    },
    componentWillReceiveProps: function (nextProps) {
        if (nextProps.gameResult == 'won') {
            this.state.wonTimes = this.state.wonTimes + 1
        } else if (nextProps.gameResult == 'lost') {
            this.state.lostTimes = this.state.lostTimes + 1
        } else if (nextProps.gameResult == 'draw') {
            this.state.drawTimes = this.state.drawTimes + 1
        }
        if (nextProps.gameResult.length > 0) {
            this.state.total = this.state.total + 1
            this.setState(this.state)
        }
    },
    render: function() {
        return (
            <div className="row">
                <div className="col-xs-12"><h3>Statistic</h3></div>
                <table className="table">
                    <thead>
                    <tr>
                        <th>Games</th>
                        <th>Won</th>
                        <th>Lost</th>
                        <th>Draw</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{this.state.total}</td>
                        <td>{this.state.wonTimes}</td>
                        <td>{this.state.lostTimes}</td>
                        <td>{this.state.drawTimes}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        );
    }
})

/**
 * Statistic for each choice
 */
var GameCardsStatisticSection = createReactClass({
    getInitialState: function() {
        return {
            userChoiceTimes: 0,
            opponentChoiceTimes: 0,
        }
    },
    componentWillReceiveProps: function (nextProps) {
        //alert(this.props.id)
        //alert(nextProps.userChoice)
        if (nextProps.userChoice == this.props.id) {
            this.state.userChoiceTimes = this.state.userChoiceTimes + 1
            this.setState(this.state)

        } else if (nextProps.opponentChoice == this.props.id) {
            this.state.opponentChoiceTimes = this.state.opponentChoiceTimes + 1
            this.setState(this.state)
        }
    },
    render: function() {
        return (
            <div className="row">
                <div className="col-xs-12"><h4>{this.props.id}</h4></div>
                <table className="table">
                    <thead>
                    <tr>
                        <th>You</th>
                        <th>Computer</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{this.state.userChoiceTimes}</td>
                        <td>{this.state.opponentChoiceTimes}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        )
    }

});



ReactDOM.render(
    <Game />,
    document.getElementById('app')
);